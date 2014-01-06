<?php

class Kore_Parser {
	
	protected $urlString;
	protected $parser;
	protected $raw;
	
	/**
	 * @throws Kore_Parser_Exception on failure
	 */
	public function __construct( $URL ){
		$this->urlString = $URL;
		$this->parser = $this->initParser($URL);
		$this->parser->init();
	}
	
	public function getTitle(){
		return $this->parser->articleTitle->innerHTML;
	}
	
	public function getContent(){
		$content = $this->parser->articleContent->innerHTML;
		$content = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $content);
		$content = str_replace( '\t', '', $content );
		return $content;
	}
	
	/**
	 * @return String of hostname
	 * @return NULL if could not be parsed
	 * 
	 * @note internally uses parse_url
	 */
	public function getHostName(){
		
		$parsed = parse_url( $this->urlString );
		if( isset( $parsed['host'] ) ){
			return $parsed['host'];
		}
	}
	public function getSnippet(){
		$charsinsnippet = Kore_Config::getConfig()->parser->charsinsnippet;
		
		//var_dump( $this->getContent()->childNodes );
		
		return substr( $this->getContent(), 0, $charsinsnippet );
	}
	
	public function getImages(){
		$content = $this->getContent();
		preg_match_all('/<img[^>]*>/Ui', $content, $media);
		$links = array();
		foreach( $media[0] as $u ){
			preg_match_all('/(src=)(\'|\")(\S*)(\"|\')/Ui', $u, $out);
			$links[] = $out[3][0];
		}
		return $links;
	}
	
	public function getRaw(){
		return $this->raw;
	}
	
	/**
	 * @throws Kore_Parser_Exception on failure to get URL
	 * @return Readability object on success
	 */
	protected function initParser( $url ){
		
		// Deal with Protocol specification
		if (!preg_match('!^https?://!i', $url)){
			$url = 'http://'.$url;
		} 
		
		// fetch Content
		$html = file_get_contents( $url );
		
		
		if( $html ){
			$this->raw = $html;
			return new Readability( $html, $url );
		} else {
			throw new Kore_Parser_Exception("Kore_Parser::initParser Failed to obtain data for specified URL" );
		}
		
	}
	
}

?>
