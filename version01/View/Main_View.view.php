<!DOCTYPE HTML>
<html><!-- InstanceBegin template="/Templates/KoreTemp.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="UTF-8">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Untitled Document</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="CSS/KoreTemp.css" rel="stylesheet" type="text/css"><!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>

<body>

<div class="container">
  <header>
  
  <div class="banner">
  
  <div class = "h-left">
    <a href="#"><img src="CSS/kolayt_alpha_logo.png" alt="Insert Logo Here" width="180" height="90" id="Insert_logo" style="background: #C6D580; display:block;" /></a>
    </div>
    
    <div class = "h-right">
    
    <div class = "h-account">
    
    <div id="banner-information">
    
    <ul>
    	
        <li> <a href="#">
        
        <div class = "user-handle"><!-- InstanceBeginEditable name="HandleRegion" --><?php echo $data['handle']; ?><!-- InstanceEndEditable -->
           
        </div>
        </a> </li>
        
        <li> <a href="#">
        <div class = "section-list"> Section </div>
        </a></li>
        
        <li> <a href="#">
        <div class = "search">Search </div>
        </a></li>
       
    </ul>
    
    </div></div></div>
    
    </div>
  </header>
  
  
  <article class="content">
  <section><!-- InstanceBeginEditable name="SectionRegion" --><?php echo $data['section_html']; ?><!-- InstanceEndEditable -->
  
  
  </section>

  <!-- end .content --></article>
  
  <footer>
    <p>This footer contains the declaration position:relative; to give Internet Explorer 6 hasLayout for the footer and cause it to clear correctly. If you're not required to support IE6, you may remove it.</p>
    <address>
      Address Content
    </address>
  </footer>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
