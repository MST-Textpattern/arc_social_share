<?php
$plugin['name'] = 'arc_social_share';
$plugin['version'] = '1.0';
$plugin['author'] = 'Andy Carter';
$plugin['author_uri'] = 'http://andy-carter.com/';
$plugin['description'] = 'Social media share links';
$plugin['order'] = '5';
$plugin['type'] = '0';

if (!defined('txpinterface'))
	@include_once('zem_tpl.php');

# --- BEGIN PLUGIN CODE ---
global $prefs, $txpcfg;

function arc_social_share_delicious($atts, $thing=null)
{
	global $thisarticle;

	extract(lAtts(array(
		'class' => '',
		'title' => null,
		'url' => null
	), $atts));
	
	$thing = ($thing===null) ? 'Share on Delicious' : parse($thing);
	
	$url = $url===null && !empty($thisarticle['thisid']) ? urlencode(permlinkurl_id($thisarticle['thisid'])) : urlencode($url);
	$title = $title===null && !empty($thisarticle['title']) ? urlencode($thisarticle['title']) : urlencode($title);
	
	$link = "http://delicious.com/post?url=$url&amp;title=$title";

	$html = href($thing, $link, ' class="'.$class.'"');
		
	return $html;
}

function arc_social_share_facebook($atts, $thing=null)
{
	global $thisarticle;

	extract(lAtts(array(
		'class' => '',
		'title' => null,
		'url' => null
	), $atts));
	
	$thing = ($thing===null) ? 'Share on Facebook' : parse($thing);
	
	$url = $url===null && !empty($thisarticle['thisid']) ? urlencode(permlinkurl_id($thisarticle['thisid'])) : urlencode($url);
	$title = $title===null && !empty($thisarticle['title']) ? urlencode($thisarticle['title']) : urlencode($title);

	$html = href($thing, "http://www.facebook.com/share.php?u=$url&amp;title=$title"
		, ' class="'.$class.'"');
		
	return $html;
}

function arc_social_share_gplus($atts, $thing=null)
{
	global $thisarticle;

	extract(lAtts(array(
		'class' => '',
		'url' => null
	), $atts));
	
	$thing = ($thing===null) ? 'Share on Google+' : parse($thing);
	
	$url = $url===null && !empty($thisarticle['thisid']) ? urlencode(permlinkurl_id($thisarticle['thisid'])) : $url;

	$html = href($thing, "https://plus.google.com/share?url=$url"
		, ' class="'.$class.'"');
		
	return $html;
}

function arc_social_share_linkedin($atts, $thing=null)
{
	global $thisarticle, $prefs;

	extract(lAtts(array(
		'class' => '',
		'source' => null,
		'summary' => null,
		'title' => null,
		'url' => null
	), $atts));
	
	$thing = ($thing===null) ? 'Share on LinkedIn' : parse($thing);
	
	$url = $url===null && !empty($thisarticle['thisid']) ? urlencode(permlinkurl_id($thisarticle['thisid'])) : urlencode($url);
	$title = $title===null && !empty($thisarticle['title']) ? urlencode($thisarticle['title']) : urlencode($title);
	$source = $source===null && !empty($prefs['sitename']) ? urldecode($prefs['sitename']) : urlencode($source);

	$link = "http://www.linkedin.com/shareArticle?mini=true&amp;url=$url&amp;title=$title&amp;source=$source";

	if (!empty($summary)) {
		$link .= "&amp;summary=$summary";
	}

	$html = href($thing, $link, ' class="'.$class.'"');
		
	return $html;
}

function arc_social_share_reddit($atts, $thing=null)
{
	global $thisarticle;

	extract(lAtts(array(
		'class' => '',
		'title' => null,
		'url' => null
	), $atts));
	
	$thing = ($thing===null) ? 'Share on Delicious' : parse($thing);
	
	$url = $url===null && !empty($thisarticle['thisid']) ? urlencode(permlinkurl_id($thisarticle['thisid'])) : urlencode($url);
	$title = $title===null && !empty($thisarticle['title']) ? urlencode($thisarticle['title']) : urlencode($title);
	
	$link = "http://www.reddit.com/submit?$url&amp;title=$title";

	$html = href($thing, $link, ' class="'.$class.'"');
		
	return $html;
}

function arc_social_share_stumbleupon($atts, $thing=null)
{
	global $thisarticle;

	extract(lAtts(array(
		'class' => '',
		'title' => null,
		'url' => null
	), $atts));
	
	$thing = ($thing===null) ? 'Share on Delicious' : parse($thing);
	
	$url = $url===null && !empty($thisarticle['thisid']) ? urlencode(permlinkurl_id($thisarticle['thisid'])) : urlencode($url);
	$title = $title===null && !empty($thisarticle['title']) ? urlencode($thisarticle['title']) : urlencode($title);
	
	$link = "http://www.stumbleupon.com/submit?$url&amp;title=$title";

	$html = href($thing, $link, ' class="'.$class.'"');
		
	return $html;
}

function arc_social_share_twitter($atts, $thing=null)
{
	global $thisarticle;

	extract(lAtts(array(
		'class' => '',
		'mention' => null,
		'title' => null,
		'url' => null
	), $atts));
	
	$thing = ($thing===null) ? 'Share on Twitter' : parse($thing);
	
	$url = $url===null && !empty($thisarticle['thisid']) ? urlencode(permlinkurl_id($thisarticle['thisid'])) : $url;
	$title = $title===null && !empty($thisarticle['title']) ? urlencode($thisarticle['title']) : urlencode($title);

	$link = "http://twitter.com/home?status=$title+$url";

	if (!empty($mention)) {
		$link .= urlencode(" /@$mention");
	}

	$html = href($thing, $link, ' class="'.$class.'"');
		
	return $html;
}


# --- END PLUGIN CODE ---
if (0) {
?>
<!--
# --- BEGIN PLUGIN HELP ---

h1. arc_social_share

Easily add links for sharing content with numerous social networks.

h2. Installation

To install go to 'Plugins' under 'Admin' and paste the plugin code into the 'Install plugin' box, 'upload' and then 'install'. You will then need to activate the plugin.

h2. The Tags

All tags have the following attributes:-

* class: class name to be applied to the link tag
* url: URL to share, use this to override the article's permlink

All tags apart from @arc_social_share_gplus@ have a 'title' attribute for overridding the article's title to be included in the share link.

h3. Delicious

bc. <txp:arc_social_share_delicious />

h3. Facebook

bc. <txp:arc_social_share_facebook />

h3. Google+

bc. <txp:arc_social_share_gplus />

h3. LinkedIn

bc. <txp:arc_social_share_linkedin />

h4. Additional Attributes

* source: by default this is your site's name
* summary: pass some summary text to LinkedIn (LinkedIn will truncate summaries greater than 256 characters long)

h3. Reddit

bc. <txp:arc_social_share_reddit />

h3. StumbleUpon

bc. <txp:arc_social_share_stumbleupon />

h3. Twitter

bc. <txp:arc_social_share_twitter />

h4. Additional Attributes

* mention: adds a Twitter username to the end of a tweet (__e.g.__ /@drmonkeyninja)

h2. Usage

The majority of the tags work the same, with a few exceptions where there are additional parameters available.

They can all be used as either a single tag or a wrapper tag. For example:-

bc. <txp:arc_social_share_twitter />

or,

bc. <txp:arc_social_share_twitter>Tweet This</txp:arc_social_share_twitter>

They're intended to work within an individual article context, so used in an article form. The URL used for sharing will be the default permlink created by Textpattern. However, you can override the URL:-

bc. <txp:arc_social_share_twitter url='http://www.example.com' />

All links created by the tags are URL encoded. 

The plugin won't do anything fancy with the way the links work when clicked. So if you want to open the links in a new window you will need to put in place some JavaScript to do this yourself. You can easily add a class to the links to help target them with your JavaScript:-

bc. <txp:arc_social_share_twitter class='bookmarklet' />

# --- END PLUGIN HELP ---
-->
<?php
}
?>
