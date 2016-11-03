<?php 
echo '<?xml version="1.0" encoding="utf-8"?>' . "\n";
?>
<rss xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:media="http://search.yahoo.com/mrss/" version="2.0">   
<channel>
<title>Onelifeconnection.com</title>
<link>

http://onelifeconnection.com/feed
</link>
<description>We are a Vietnam-based, professional service-provider in the field of leadership and performance training and coaching. We work with individuals, teams and organizations to build transformational leadership one person at a time.</description>
<dc:language>en-en</dc:language>
<dc:creator>info@onelifeconnection.com</dc:creator>
<dc:rights> Copyright <?php echo gmdate("Y", time()); ?> </dc:rights>
<?php	foreach($listblog as $item):
			$link_blog 				= base_url()."blog/".$item->cat."/".$item->id.'/'.$item->title_url.".html";
			$dateblog 				 = date('M j ,Y', $item->date);
			$title = $lang=='en'?$item->title_en:$item->title_vn;
			$fileXmlblog 				     = "./xmldata/".$lang."/blog/".$item->id.".xml";
			$readXmlblog 	                 = simplexml_load_file($fileXmlblog);		
			
			?>
<item>
<title><?php echo $title?> </title>

<link>
<?php echo $link_blog; ?>
</link>
<guid><?php echo $link_blog; ?></guid>
<description>
  <![CDATA[<?=character_limiter(strip_tags($readXmlblog->info->content),200)?> ]]>
</description>
<pubDate><?php echo date ('r', $item->date);?></pubDate>
<media:content  url='<?=base_url()?>upload/blog/<?=$item->image?>' height='75' width='75' />   
     
</item>
<?php endforeach; ?>
</channel>
</rss>
