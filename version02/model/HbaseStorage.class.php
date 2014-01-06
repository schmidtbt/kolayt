<?php

/**
 * 
 * @author Revan
 */
class HbaseStorage extends StorageDefinition {
    
    public static $map = array(
        
        // NODES
        'UserNode'          => 'users',
        'TagNode'           => 'tags',
        'URLNode'           => 'urls',
        'ShortenerNode'     => 'shortener',
        'EmailNode'         => 'emailaddr',
        'MediaNode'         => 'media',
        'MediaImageNode'    => 'media',
        'MediaVideoNode'    => 'media',
        'AutoIndexNode'     => 'autoindex',
        'TokenNode'         => 'tokens',
        
        // EDGES
        'UserFollowerEdge'  => 'userfollowers',
        'URLTagEdge'        => 'url_tags',
        'TagURLEdge'        => 'tag_urls',
        'URLMediaEdge'      => 'url_media',
        'MediaURLEdge'      => 'media_url',
        'TagTagEdge'        => 'tag_tag',
        'UserUserEdge'      => 'user_user',
        'UserFollowersEdge' => 'user_user',
        'UserFollowingEdge' => 'user_user',
        'UserTagEdge'       => 'user_tag',
        'TagUserEdge'       => 'tag_user',
        'UserActionEdge'    => 'user_action',
        'URLActionEdge'     => 'url_action',
        'UserStreamEdge'    => 'user_stream',
        'UserStreamRankedEdge'=>'user_rank_stream'
        
    );
    
}

?>
