<?php
if ( class_exists( 'BoldThemesFramework' ) && isset( BoldThemesFramework::$crush_vars ) ) {
	$boldthemes_crush_vars = apply_filters( 'boldthemes_crush_vars', BoldThemesFramework::$crush_vars );
}
if ( class_exists( 'BoldThemesFramework' ) && isset( BoldThemesFramework::$crush_vars_def ) ) {
	$boldthemes_crush_vars_def = BoldThemesFramework::$crush_vars_def;
}
if ( isset( $boldthemes_crush_vars['accentColor'] ) ) {
	$accentColor = $boldthemes_crush_vars['accentColor'];
} else {
	$accentColor = "#ff3b2b";
}
if ( isset( $boldthemes_crush_vars['alternateColor'] ) ) {
	$alternateColor = $boldthemes_crush_vars['alternateColor'];
} else {
	$alternateColor = "#06305f";
}
if ( isset( $boldthemes_crush_vars['bodyFont'] ) ) {
	$bodyFont = $boldthemes_crush_vars['bodyFont'];
} else {
	$bodyFont = "Roboto Condensed";
}
if ( isset( $boldthemes_crush_vars['menuFont'] ) ) {
	$menuFont = $boldthemes_crush_vars['menuFont'];
} else {
	$menuFont = "Roboto Condensed";
}
if ( isset( $boldthemes_crush_vars['headingFont'] ) ) {
	$headingFont = $boldthemes_crush_vars['headingFont'];
} else {
	$headingFont = "Vidaloka";
}
if ( isset( $boldthemes_crush_vars['headingSuperTitleFont'] ) ) {
	$headingSuperTitleFont = $boldthemes_crush_vars['headingSuperTitleFont'];
} else {
	$headingSuperTitleFont = "PT Serif";
}
if ( isset( $boldthemes_crush_vars['headingSubTitleFont'] ) ) {
	$headingSubTitleFont = $boldthemes_crush_vars['headingSubTitleFont'];
} else {
	$headingSubTitleFont = "PT Serif";
}
if ( isset( $boldthemes_crush_vars['buttonFont'] ) ) {
	$buttonFont = $boldthemes_crush_vars['buttonFont'];
} else {
	$buttonFont = "Roboto Condensed";
}
if ( isset( $boldthemes_crush_vars['logoHeight'] ) ) {
	$logoHeight = $boldthemes_crush_vars['logoHeight'];
} else {
	$logoHeight = "140";
}
$accentColorDark = CssCrush\fn__l_adjust( $accentColor." -15" );$accentColorVeryDark = CssCrush\fn__l_adjust( $accentColor." -35" );$accentColorVeryVeryDark = CssCrush\fn__l_adjust( $accentColor." -42" );$accentColorLight = CssCrush\fn__a_adjust( $accentColor." -30" );$alternateColorDark = CssCrush\fn__l_adjust( $alternateColor." -15" );$alternateColorVeryDark = CssCrush\fn__l_adjust( $alternateColor." -25" );$alternateColorLight = CssCrush\fn__a_adjust( $alternateColor." -40" );$css_override = sanitize_text_field("::selection{background: {$accentColor};}
select,
input{font-family: \"{$bodyFont}\",Arial,Helvetica,sans-serif;}
input[type=\"file\"]::-webkit-file-upload-button{background: {$accentColor} !important;
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;}
input[type=\"checkbox\"]:after{
    color: {$accentColor};}
input[type=\"radio\"]:after{
    color: {$accentColor};}
.fancy-select ul.options li:before{
    background: {$accentColor};}
.fancy-select ul.options li:hover{color: {$accentColor};}
.bt-content .btPostSingleItemStandard .btArticleContent a:not(.wp-block-button__link){color: {$accentColor};}
a:hover:not(.wp-block-button__link){color: {$accentColor};}
.btText a{color: {$accentColor};}
body{font-family: \"{$bodyFont}\",Arial,Helvetica,sans-serif;}
h1,
h2,
h3,
h4,
h5,
h6{font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
blockquote{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
blockquote:before{
    color: {$accentColor};}
.bt-content-holder table th{
    background-color: {$accentColor};}
.btAccentDarkHeader .btPreloader .animation > div:first-child,
.btLightAccentHeader .btPreloader .animation > div:first-child,
.btTransparentLightHeader .btPreloader .animation > div:first-child{
    background-color: {$accentColor};}
.btPreloader .animation .preloaderLogo{height: {$logoHeight}px;}
.btLoader:after{
    background: {$accentColor};}
body.error404 .bt-error-page .bt_bb_port .bt_bb_cell .bt_bb_headline_subheadline .bt_bb_button .bt_bb_link,
body.error404 .btErrorPage .bt_bb_port .bt_bb_cell .bt_bb_headline_subheadline .bt_bb_button .bt_bb_link{
    -webkit-box-shadow: 0 0 0 2em {$accentColor} inset;
    box-shadow: 0 0 0 2em {$accentColor} inset;}
body.error404 .bt-error-page .bt_bb_port .bt_bb_cell .bt_bb_headline_subheadline .bt_bb_button .bt_bb_link:hover,
body.error404 .btErrorPage .bt_bb_port .bt_bb_cell .bt_bb_headline_subheadline .bt_bb_button .bt_bb_link:hover{-webkit-box-shadow: 0 0 0 2em {$accentColor} inset,0 5px 20px rgba(0,0,0,.2);
    box-shadow: 0 0 0 2em {$accentColor} inset,0 5px 20px rgba(0,0,0,.2);}
.bt_bb_touch body.btBelowMenu .btPageHeadline .bt_bb_port{padding-top: -webkit-calc(6em + {$logoHeight}px*0.6);
    padding-top: -moz-calc(6em + {$logoHeight}px*0.6);
    padding-top: calc(6em + {$logoHeight}px*0.6);}
.btPageHeadlineLightAccent .btPageHeadline:before{background: {$accentColor};}
.btPageHeadlineLightAccent .btPageHeadline.bt_bb_background_image:before{background: -webkit-linear-gradient(top,{$accentColor} -20%,transparent 50%),-webkit-linear-gradient(bottom,{$accentColor} 0%,transparent 80%);
    background: -moz-linear-gradient(top,{$accentColor} -20%,transparent 50%),-moz-linear-gradient(bottom,{$accentColor} 0%,transparent 80%);
    background: linear-gradient(to bottom,{$accentColor} -20%,transparent 50%),linear-gradient(to top,{$accentColor} 0%,transparent 80%);}
.btPageHeadlineLightAccent .btPageHeadline .btArticleCategories:before,
.btPageHeadlineLightAccent .btPageHeadline .btArticleAuthor:before,
.btPageHeadlineLightAccent .btPageHeadline .btArticleDate:before,
.btPageHeadlineLightAccent .btPageHeadline .btArticleComments:before{color: {$alternateColor};}
.btPageHeadlineLightAccent .btPageHeadline .bt_bb_dash_bottom.bt_bb_headline .bt_bb_headline_content:after{background: {$alternateColor};}
.btPageHeadlineDarkAccent .btPageHeadline:before{background: {$accentColor};}
.btPageHeadlineDarkAccent .btPageHeadline.bt_bb_background_image:before{background: -webkit-linear-gradient(top,{$accentColor} -20%,transparent 50%),-webkit-linear-gradient(bottom,{$accentColor} 0%,transparent 80%);
    background: -moz-linear-gradient(top,{$accentColor} -20%,transparent 50%),-moz-linear-gradient(bottom,{$accentColor} 0%,transparent 80%);
    background: linear-gradient(to bottom,{$accentColor} -20%,transparent 50%),linear-gradient(to top,{$accentColor} 0%,transparent 80%);}
.btPageHeadlineLightAlternate .btPageHeadline:before{background: {$alternateColor};}
.btPageHeadlineLightAlternate .btPageHeadline.bt_bb_background_image:before{background: -webkit-linear-gradient(top,{$alternateColor} -20%,transparent 50%),-webkit-linear-gradient(bottom,{$alternateColor} 0%,transparent 80%);
    background: -moz-linear-gradient(top,{$alternateColor} -20%,transparent 50%),-moz-linear-gradient(bottom,{$alternateColor} 0%,transparent 80%);
    background: linear-gradient(to bottom,{$alternateColor} -20%,transparent 50%),linear-gradient(to top,{$alternateColor} 0%,transparent 80%);}
.btPageHeadlineLightAlternate .btPageHeadline .btArticleCategories:before,
.btPageHeadlineLightAlternate .btPageHeadline .btArticleAuthor:before,
.btPageHeadlineLightAlternate .btPageHeadline .btArticleDate:before,
.btPageHeadlineLightAlternate .btPageHeadline .btArticleComments:before{color: {$accentColor};}
.btPageHeadlineLightAlternate .btPageHeadline .bt_bb_dash_bottom.bt_bb_headline .bt_bb_headline_content:after{background: {$accentColor};}
.btPageHeadlineDarkAlternate .btPageHeadline:before{background: {$alternateColor};}
.btPageHeadlineDarkAlternate .btPageHeadline.bt_bb_background_image:before{background: -webkit-linear-gradient(top,{$alternateColor} -20%,transparent 50%),-webkit-linear-gradient(bottom,{$alternateColor} 0%,transparent 80%);
    background: -moz-linear-gradient(top,{$alternateColor} -20%,transparent 50%),-moz-linear-gradient(bottom,{$alternateColor} 0%,transparent 80%);
    background: linear-gradient(to bottom,{$alternateColor} -20%,transparent 50%),linear-gradient(to top,{$alternateColor} 0%,transparent 80%);}
.btPageHeadlineDarkAlternate .btPageHeadline .btArticleCategories:before,
.btPageHeadlineDarkAlternate .btPageHeadline .btArticleAuthor:before,
.btPageHeadlineDarkAlternate .btPageHeadline .btArticleDate:before,
.btPageHeadlineDarkAlternate .btPageHeadline .btArticleComments:before{color: {$accentColor};}
.btPageHeadlineDarkAlternate .btPageHeadline .bt_bb_dash_bottom.bt_bb_headline .bt_bb_headline_content:after{background: {$accentColor};}
.bt-no-search-results .bt_bb_port #searchform input[type='submit']{
    background: {$accentColor};
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;}
.bt-no-search-results .bt_bb_port .bt_bb_button a{
    background: {$accentColor};}
.bt-no-search-results .bt_bb_port .bt_bb_button a .bt_bb_button_text{font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;}
.mainHeader{
    font-family: \"{$menuFont}\",Arial,Helvetica,sans-serif;}
.mainHeader a:hover{color: {$accentColor};}
.menuPort{
    font-family: \"{$menuFont}\",Arial,Helvetica,sans-serif;}
.menuPort nav > ul > li > a{line-height: {$logoHeight}px;}
.btTextLogo{
    font-family: \"{$menuFont}\",Arial,Helvetica,sans-serif;
    line-height: {$logoHeight}px;
    line-height: max(50px,{$logoHeight}px);}
.btMenuVertical .bt-vertical-header-top .btTextLogo{line-height: -webkit-calc({$logoHeight}px*0.5);
    line-height: -moz-calc({$logoHeight}px*0.5);
    line-height: calc({$logoHeight}px*0.5);
    line-height: max(50px,-webkit-calc({$logoHeight}px*0.5));
    line-height: max(50px,-moz-calc({$logoHeight}px*0.5));
    line-height: max(50px,calc({$logoHeight}px*0.5));}
.bt-logo-area .logo img{height: {$logoHeight}px;}
.bt-horizontal-menu-trigger{
    line-height: {$logoHeight}px;
    line-height: max(50px,{$logoHeight}px);}
.btStickyHeaderActive .bt-horizontal-menu-trigger{line-height: -webkit-calc({$logoHeight}px*0.6);
    line-height: -moz-calc({$logoHeight}px*0.6);
    line-height: calc({$logoHeight}px*0.6);
    line-height: max(50px,-webkit-calc({$logoHeight}px*0.6));
    line-height: max(50px,-moz-calc({$logoHeight}px*0.6));
    line-height: max(50px,calc({$logoHeight}px*0.6));}
.bt-horizontal-menu-trigger .bt_bb_icon:before,
.bt-horizontal-menu-trigger .bt_bb_icon:after{
    background: {$accentColor};}
.bt-horizontal-menu-trigger .bt_bb_icon > div{
    background: {$accentColor};}
.btMenuHorizontal .menuPort nav > ul > li > a:after{
    background-color: {$accentColor};}
.btMenuHorizontal .menuPort nav > ul > li > ul > li.menu-item-has-children > a:before{
    background: {$accentColor};}
.btMenuHorizontal .menuPort ul ul li a:after{
    background: {$accentColor};}
.btMenuHorizontal .menuPort ul ul li a:hover{color: {$accentColor};}
body.btMenuHorizontal .subToggler{
    height: -webkit-calc({$logoHeight}px * .5);
    height: -moz-calc({$logoHeight}px * .5);
    height: calc({$logoHeight}px * .5);}
.btMenuHorizontal .menuPort > nav > ul > li{margin: -webkit-calc({$logoHeight}px * .25) -webkit-calc(50px * .2) -webkit-calc({$logoHeight}px * .25) 0;
    margin: -moz-calc({$logoHeight}px * .25) -moz-calc(50px * .2) -moz-calc({$logoHeight}px * .25) 0;
    margin: calc({$logoHeight}px * .25) calc(50px * .2) calc({$logoHeight}px * .25) 0;}
.btMenuHorizontal .menuPort > nav > ul > li > a{line-height: -webkit-calc({$logoHeight}px * .5);
    line-height: -moz-calc({$logoHeight}px * .5);
    line-height: calc({$logoHeight}px * .5);}
.rtl.btMenuHorizontal .menuPort > nav > ul > li{margin: -webkit-calc({$logoHeight}px * .25) 0 -webkit-calc({$logoHeight}px * .25) -webkit-calc(50px * .2);
    margin: -moz-calc({$logoHeight}px * .25) 0 -moz-calc({$logoHeight}px * .25) -moz-calc(50px * .2);
    margin: calc({$logoHeight}px * .25) 0 calc({$logoHeight}px * .25) calc(50px * .2);}
.btMenuHorizontal .menuPort > nav > ul > li > ul > li{font-family: \"{$menuFont}\",Arial,Helvetica,sans-serif;}
.btMenuHorizontal .topBarInMenu{
    height: {$logoHeight}px;}
.btMenuHorizontal .topBarInMenu .topBarInMenuCell{line-height: -webkit-calc({$logoHeight}px*0.6);
    line-height: -moz-calc({$logoHeight}px*0.6);
    line-height: calc({$logoHeight}px*0.6);
    line-height: max(50px,-webkit-calc({$logoHeight}px*0.6));
    line-height: max(50px,-moz-calc({$logoHeight}px*0.6));
    line-height: max(50px,calc({$logoHeight}px*0.6));}
.btAccentLightHeader .bt-below-logo-area,
.btAccentLightHeader .topBar{background-color: {$accentColor};}
.btAccentDarkHeader .bt-below-logo-area,
.btAccentDarkHeader .topBar{background-color: {$accentColor};}
.btLightAccentHeader .bt-logo-area,
.btLightAccentHeader .bt-vertical-header-top{background-color: {$accentColor};}
.btLightAccentHeader.btMenuHorizontal.btBelowMenu .mainHeader .bt-logo-area{background-color: {$accentColor};}
.btAlternateLightHeader .bt-logo-area,
.btAlternateLightHeader .bt-vertical-header-top{background-color: {$alternateColor};}
.btAlternateLightHeader.btMenuHorizontal.btBelowMenu .mainHeader .bt-logo-area{background-color: {$alternateColor};}
.btLightAlternateHeader .bt-below-logo-area,
.btLightAlternateHeader .topBar{background-color: {$alternateColor};}
.btAlternateDarkHeader .bt-logo-area,
.btAlternateDarkHeader .bt-vertical-header-top{background-color: {$alternateColor};}
.btAlternateDarkHeader.btMenuHorizontal.btBelowMenu .mainHeader .bt-logo-area{background-color: {$alternateColor};}
.btDarkAlternateHeader .bt-below-logo-area,
.btDarkAlternateHeader .topBar{background-color: {$alternateColor};}
.btStickyHeaderActive.btMenuHorizontal .mainHeader .bt-logo-area .logo img{height: -webkit-calc({$logoHeight}px*0.6);
    height: -moz-calc({$logoHeight}px*0.6);
    height: calc({$logoHeight}px*0.6);
    height: max(50px,-webkit-calc({$logoHeight}px*0.6));
    height: max(50px,-moz-calc({$logoHeight}px*0.6));
    height: max(50px,calc({$logoHeight}px*0.6));}
.btStickyHeaderActive.btMenuHorizontal .mainHeader .bt-logo-area .btTextLogo{
    line-height: -webkit-calc({$logoHeight}px*0.6);
    line-height: -moz-calc({$logoHeight}px*0.6);
    line-height: calc({$logoHeight}px*0.6);
    line-height: max(50px,-webkit-calc({$logoHeight}px*0.6));
    line-height: max(50px,-moz-calc({$logoHeight}px*0.6));
    line-height: max(50px,calc({$logoHeight}px*0.6));}
.btStickyHeaderActive.btMenuHorizontal .mainHeader .bt-logo-area .menuPort nav > ul > li{margin-top: -webkit-calc({$logoHeight}px * .05);
    margin-top: -moz-calc({$logoHeight}px * .05);
    margin-top: calc({$logoHeight}px * .05);
    margin-bottom: -webkit-calc({$logoHeight}px * .05);
    margin-bottom: -moz-calc({$logoHeight}px * .05);
    margin-bottom: calc({$logoHeight}px * .05);}
.btStickyHeaderActive.btMenuHorizontal .mainHeader .bt-logo-area .topBarInMenu{height: -webkit-calc({$logoHeight}px*0.6);
    height: -moz-calc({$logoHeight}px*0.6);
    height: calc({$logoHeight}px*0.6);
    height: max(50px,-webkit-calc({$logoHeight}px*0.6));
    height: max(50px,-moz-calc({$logoHeight}px*0.6));
    height: max(50px,calc({$logoHeight}px*0.6));}
.btStickyHeaderActive.btMenuBelowLogo.btMenuBelowLogoShowArea.btMenuHorizontal .mainHeader .bt-logo-area .topBarInLogoArea{height: -webkit-calc({$logoHeight}px*0.6);
    height: -moz-calc({$logoHeight}px*0.6);
    height: calc({$logoHeight}px*0.6);
    height: max(50px,-webkit-calc({$logoHeight}px*0.6));
    height: max(50px,-moz-calc({$logoHeight}px*0.6));
    height: max(50px,calc({$logoHeight}px*0.6));}
.bt-vertical-menu-trigger .bt_bb_icon:before,
.bt-vertical-menu-trigger .bt_bb_icon:after{
    background: {$accentColor};}
.bt-vertical-menu-trigger .bt_bb_icon > div{
    background: {$accentColor};}
.btMenuVertical .mainHeader .btCloseVertical:before:hover{color: {$accentColor};}
.btMenuVertical .mainHeader nav ul li a:after{
    background: {$accentColor};}
.btMenuHorizontal .topBarInLogoArea{
    height: {$logoHeight}px;}
.btMenuHorizontal .topBarInLogoArea .topBarInLogoAreaCell{border: 0 solid {$accentColor};}
.btLightAccentHeader.btMenuVerticalFullscreenEnabled .mainHeader .menuPort{
    background: {$accentColor} !important;}
.btAlternateLightHeader.btMenuVerticalFullscreenEnabled .mainHeader .menuPort{
    background: {$alternateColor} !important;}
.btAlternateDarkHeader.btMenuVerticalFullscreenEnabled .mainHeader .menuPort{
    background: {$alternateColor} !important;}
.btTransparentLightHeader.btMenuVerticalFullscreenEnabled.btMenuHorizontal .mainHeader .menuPort{
    background: {$alternateColor} !important;}
.btTransparentLightHeader.btMenuVerticalFullscreenEnabled.btMenuHorizontal .mainHeader .menuPort .header_fullscreen_image:before{background: -webkit-linear-gradient(left,{$alternateColor} 20%,transparent 100%);
    background: -moz-linear-gradient(left,{$alternateColor} 20%,transparent 100%);
    background: linear-gradient(to right,{$alternateColor} 20%,transparent 100%);}
.btLightAccentHeader.btMenuVerticalFullscreenEnabled.btMenuHorizontal .mainHeader .menuPort .header_fullscreen_image:before{background: -webkit-linear-gradient(left,{$accentColor} 20%,transparent 100%);
    background: -moz-linear-gradient(left,{$accentColor} 20%,transparent 100%);
    background: linear-gradient(to right,{$accentColor} 20%,transparent 100%);}
.btAlternateLightHeader.btMenuVerticalFullscreenEnabled.btMenuHorizontal .mainHeader .menuPort .header_fullscreen_image:before{background: -webkit-linear-gradient(left,{$alternateColor} 20%,transparent 100%);
    background: -moz-linear-gradient(left,{$alternateColor} 20%,transparent 100%);
    background: linear-gradient(to right,{$alternateColor} 20%,transparent 100%);}
.btTransparentLightHeader.btMenuVerticalFullscreenEnabled.btMenuHorizontal .mainHeader .menuPort .header_fullscreen_image:after{background: {$alternateColor};}
.btLightAccentHeader.btMenuVerticalFullscreenEnabled.btMenuHorizontal .mainHeader .menuPort .header_fullscreen_image:after{background: {$accentColor};}
.btAlternateLightHeader.btMenuVerticalFullscreenEnabled.btMenuHorizontal .mainHeader .menuPort .header_fullscreen_image:after{background: {$alternateColor};}
.btTransparentLightHeader.btMenuVerticalFullscreenEnabled.btMenuHorizontal .mainHeader.gutter .header_fullscreen_image:before{background: -webkit-linear-gradient(left,{$alternateColor} 40%,transparent 100%);
    background: -moz-linear-gradient(left,{$alternateColor} 40%,transparent 100%);
    background: linear-gradient(to right,{$alternateColor} 40%,transparent 100%);}
.btLightAccentHeader.btMenuVerticalFullscreenEnabled.btMenuHorizontal .mainHeader.gutter .header_fullscreen_image:before{background: -webkit-linear-gradient(left,{$accentColor} 40%,transparent 100%);
    background: -moz-linear-gradient(left,{$accentColor} 40%,transparent 100%);
    background: linear-gradient(to right,{$accentColor} 40%,transparent 100%);}
.btAlternateLightHeader.btMenuVerticalFullscreenEnabled.btMenuHorizontal .mainHeader.gutter .header_fullscreen_image:before{background: -webkit-linear-gradient(left,{$alternateColor} 40%,transparent 100%);
    background: -moz-linear-gradient(left,{$alternateColor} 40%,transparent 100%);
    background: linear-gradient(to right,{$alternateColor} 40%,transparent 100%);}
.btMenuVerticalFullscreenEnabled.btMenuVertical.btTransparentLightHeader .mainHeader{background: {$alternateColor} !important;}
.btMenuVerticalFullscreenEnabled.btMenuVertical.btTransparentLightHeader .mainHeader .menuPort{
    background: {$alternateColor} !important;}
.btMenuVerticalFullscreenEnabled:not(.btMenuVertical) .mainHeader .menuPort{
    padding: -webkit-calc({$logoHeight}px * 1.25) 30px;
    padding: -moz-calc({$logoHeight}px * 1.25) 30px;
    padding: calc({$logoHeight}px * 1.25) 30px;}
.btStickyHeaderActive.btMenuVerticalFullscreenEnabled:not(.btMenuVertical) .mainHeader .menuPort{top: -webkit-calc({$logoHeight}px*0.6);
    top: -moz-calc({$logoHeight}px*0.6);
    top: calc({$logoHeight}px*0.6);
    height: -webkit-calc(100vh - {$logoHeight}px*0.6);
    height: -moz-calc(100vh - {$logoHeight}px*0.6);
    height: calc(100vh - {$logoHeight}px*0.6);}
.bt-site-footer .bt-footer-menu .menu li a:after{
    background-color: {$accentColor};}
.btDarkSkin .bt-site-footer-copy-menu .port:before,
.btLightSkin .btDarkSkin .bt-site-footer-copy-menu .port:before,
.btDarkSkin.btLightSkin .btDarkSkin .bt-site-footer-copy-menu .port:before{background-color: {$accentColor};}
.bt-content .btArticleHeadline .bt_bb_headline .bt_bb_headline_content a:hover,
.bt-content .btArticleListItem .bt_bb_headline .bt_bb_headline_content a:hover{color: {$accentColor};}
.btPostSingleItemStandard .btArticleShareEtc > div.btReadMoreColumn .bt_bb_button a{
    background: {$accentColor};}
.btPostSingleItemStandard .btArticleShareEtc > div.btReadMoreColumn .bt_bb_button a .bt_bb_button_text{font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;}
.btAboutAuthor .aaTxt h1 .btArticleAuthor a:before,
.btAboutAuthor .aaTxt h2 .btArticleAuthor a:before,
.btAboutAuthor .aaTxt h3 .btArticleAuthor a:before,
.btAboutAuthor .aaTxt h4 .btArticleAuthor a:before,
.btAboutAuthor .aaTxt h5 .btArticleAuthor a:before,
.btAboutAuthor .aaTxt h6 .btArticleAuthor a:before,
.btAboutAuthor .aaTxt h7 .btArticleAuthor a:before,
.btAboutAuthor .aaTxt h8 .btArticleAuthor a:before,
.btAboutAuthor .aaTxt h1 .btArticleAuthor a:after,
.btAboutAuthor .aaTxt h2 .btArticleAuthor a:after,
.btAboutAuthor .aaTxt h3 .btArticleAuthor a:after,
.btAboutAuthor .aaTxt h4 .btArticleAuthor a:after,
.btAboutAuthor .aaTxt h5 .btArticleAuthor a:after,
.btAboutAuthor .aaTxt h6 .btArticleAuthor a:after,
.btAboutAuthor .aaTxt h7 .btArticleAuthor a:after,
.btAboutAuthor .aaTxt h8 .btArticleAuthor a:after{
    color: {$accentColor};}
.btAboutAuthor .aaTxt h1 .btArticleAuthor a:before,
.btAboutAuthor .aaTxt h2 .btArticleAuthor a:before,
.btAboutAuthor .aaTxt h3 .btArticleAuthor a:before,
.btAboutAuthor .aaTxt h4 .btArticleAuthor a:before,
.btAboutAuthor .aaTxt h5 .btArticleAuthor a:before,
.btAboutAuthor .aaTxt h6 .btArticleAuthor a:before,
.btAboutAuthor .aaTxt h7 .btArticleAuthor a:before,
.btAboutAuthor .aaTxt h8 .btArticleAuthor a:before{
    color: {$accentColor};}
.btAboutAuthor .aaTxt h1 .btArticleAuthor a:after,
.btAboutAuthor .aaTxt h2 .btArticleAuthor a:after,
.btAboutAuthor .aaTxt h3 .btArticleAuthor a:after,
.btAboutAuthor .aaTxt h4 .btArticleAuthor a:after,
.btAboutAuthor .aaTxt h5 .btArticleAuthor a:after,
.btAboutAuthor .aaTxt h6 .btArticleAuthor a:after,
.btAboutAuthor .aaTxt h7 .btArticleAuthor a:after,
.btAboutAuthor .aaTxt h8 .btArticleAuthor a:after{
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;
    color: {$accentColor};
    -webkit-box-shadow: 0 1px 0 0 {$accentColor};
    box-shadow: 0 1px 0 0 {$accentColor};}
.btAboutAuthor .aaTxt h1 .btArticleAuthor a:hover:after,
.btAboutAuthor .aaTxt h2 .btArticleAuthor a:hover:after,
.btAboutAuthor .aaTxt h3 .btArticleAuthor a:hover:after,
.btAboutAuthor .aaTxt h4 .btArticleAuthor a:hover:after,
.btAboutAuthor .aaTxt h5 .btArticleAuthor a:hover:after,
.btAboutAuthor .aaTxt h6 .btArticleAuthor a:hover:after,
.btAboutAuthor .aaTxt h7 .btArticleAuthor a:hover:after,
.btAboutAuthor .aaTxt h8 .btArticleAuthor a:hover:after{-webkit-box-shadow: 0 0 0 0 {$accentColor};
    box-shadow: 0 0 0 0 {$accentColor};}
.btMediaBox.btQuote:before,
.btMediaBox.btLink:before{
    background-color: {$accentColor};}
.sticky.btArticleListItem .btArticleHeadline h1 .bt_bb_headline_content span a:after,
.sticky.btArticleListItem .btArticleHeadline h2 .bt_bb_headline_content span a:after,
.sticky.btArticleListItem .btArticleHeadline h3 .bt_bb_headline_content span a:after,
.sticky.btArticleListItem .btArticleHeadline h4 .bt_bb_headline_content span a:after,
.sticky.btArticleListItem .btArticleHeadline h5 .bt_bb_headline_content span a:after,
.sticky.btArticleListItem .btArticleHeadline h6 .bt_bb_headline_content span a:after,
.sticky.btArticleListItem .btArticleHeadline h7 .bt_bb_headline_content span a:after,
.sticky.btArticleListItem .btArticleHeadline h8 .bt_bb_headline_content span a:after{
    color: {$accentColor};}
.btPostSingleItemColumns .btTagsbtTags ul a:hover{background: {$accentColor};}
.post-password-form p:nth-child(2) input[type=\"submit\"]{
    background: {$accentColor};}
.btPagination{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.btPagination .paging p a:hover{
    background: {$accentColor};}
.btPrevNextNav .btPrevNext .btPrevNextItem .btPrevNextTitle{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.btPrevNextNav .btPrevNext:hover:after{background: {$accentColor};}
.btPrevNextNav .btPrevNext:hover .btPrevNextTitle{color: {$accentColor} !important;}
.bt-link-pages ul a.post-page-numbers:hover{
    background: {$accentColor};}
.btArticleCategories:before,
.btArticleAuthor:before,
.btArticleDate:before,
.btArticleComments:before{
    color: {$accentColor};}
.btCommentsBox ul.comments li.pingback p a:not(.comment-edit-link),
.btCommentsBox ul.comments li.trackback p a:not(.comment-edit-link),
.bt-comments-box ul.comments li.pingback p a:not(.comment-edit-link),
.bt-comments-box ul.comments li.trackback p a:not(.comment-edit-link){font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.btCommentsBox ul.comments li.pingback p a:not(.comment-edit-link):hover,
.btCommentsBox ul.comments li.trackback p a:not(.comment-edit-link):hover,
.bt-comments-box ul.comments li.pingback p a:not(.comment-edit-link):hover,
.bt-comments-box ul.comments li.trackback p a:not(.comment-edit-link):hover{color: {$accentColor} !important;}
.btCommentsBox ul.comments li.pingback p .edit-link,
.btCommentsBox ul.comments li.trackback p .edit-link,
.bt-comments-box ul.comments li.pingback p .edit-link,
.bt-comments-box ul.comments li.trackback p .edit-link{font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;}
.btCommentsBox ul.comments li.pingback p .edit-link a,
.btCommentsBox ul.comments li.trackback p .edit-link a,
.bt-comments-box ul.comments li.pingback p .edit-link a,
.bt-comments-box ul.comments li.trackback p .edit-link a{
    color: {$accentColor};}
.btCommentsBox .vcard h1.author a:hover,
.btCommentsBox .vcard h2.author a:hover,
.btCommentsBox .vcard h3.author a:hover,
.btCommentsBox .vcard h4.author a:hover,
.btCommentsBox .vcard h5.author a:hover,
.btCommentsBox .vcard h6.author a:hover,
.btCommentsBox .vcard h7.author a:hover,
.btCommentsBox .vcard h8.author a:hover,
.bt-comments-box .vcard h1.author a:hover,
.bt-comments-box .vcard h2.author a:hover,
.bt-comments-box .vcard h3.author a:hover,
.bt-comments-box .vcard h4.author a:hover,
.bt-comments-box .vcard h5.author a:hover,
.bt-comments-box .vcard h6.author a:hover,
.bt-comments-box .vcard h7.author a:hover,
.bt-comments-box .vcard h8.author a:hover{color: {$accentColor};}
.btCommentsBox .vcard .posted:before,
.bt-comments-box .vcard .posted:before{
    color: {$accentColor};}
.btCommentsBox .commentTxt .comment p.reply a,
.bt-comments-box .commentTxt .comment p.reply a{font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;}
.btCommentsBox .commentTxt .comment p.reply a:hover,
.bt-comments-box .commentTxt .comment p.reply a:hover{
    background: {$accentColor};}
.btCommentsBox .commentTxt .comment p.edit-link a:hover,
.bt-comments-box .commentTxt .comment p.edit-link a:hover{
    background: {$accentColor};}
.btCommentsBox .comment-form .comment-notes a:first-child:hover,
.btCommentsBox .comment-form .logged-in-as a:first-child:hover,
.btCommentsBox + #review_form_wrapper .comment-form .comment-notes a:first-child:hover,
.btCommentsBox + #review_form_wrapper .comment-form .logged-in-as a:first-child:hover,
.bt-comments-box .comment-form .comment-notes a:first-child:hover,
.bt-comments-box .comment-form .logged-in-as a:first-child:hover,
.bt-comments-box + #review_form_wrapper .comment-form .comment-notes a:first-child:hover,
.bt-comments-box + #review_form_wrapper .comment-form .logged-in-as a:first-child:hover{color: {$accentColor} !important;}
.btCommentsBox .comment-form .comment-notes a:last-child,
.btCommentsBox .comment-form .logged-in-as a:last-child,
.btCommentsBox + #review_form_wrapper .comment-form .comment-notes a:last-child,
.btCommentsBox + #review_form_wrapper .comment-form .logged-in-as a:last-child,
.bt-comments-box .comment-form .comment-notes a:last-child,
.bt-comments-box .comment-form .logged-in-as a:last-child,
.bt-comments-box + #review_form_wrapper .comment-form .comment-notes a:last-child,
.bt-comments-box + #review_form_wrapper .comment-form .logged-in-as a:last-child{
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;}
.btCommentsBox .comment-form .comment-notes a:last-child:hover,
.btCommentsBox .comment-form .logged-in-as a:last-child:hover,
.btCommentsBox + #review_form_wrapper .comment-form .comment-notes a:last-child:hover,
.btCommentsBox + #review_form_wrapper .comment-form .logged-in-as a:last-child:hover,
.bt-comments-box .comment-form .comment-notes a:last-child:hover,
.bt-comments-box .comment-form .logged-in-as a:last-child:hover,
.bt-comments-box + #review_form_wrapper .comment-form .comment-notes a:last-child:hover,
.bt-comments-box + #review_form_wrapper .comment-form .logged-in-as a:last-child:hover{
    background: {$accentColor};}
.btCommentsBox .comment-form > .pc-item label span.required,
.btCommentsBox + #review_form_wrapper .comment-form > .pc-item label span.required,
.bt-comments-box .comment-form > .pc-item label span.required,
.bt-comments-box + #review_form_wrapper .comment-form > .pc-item label span.required{
    background: {$accentColor};}
.btCommentsBox .comment-navigation a,
.bt-comments-box .comment-navigation a{
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;}
.btCommentsBox .comment-navigation a:hover,
.bt-comments-box .comment-navigation a:hover{color: {$accentColor};}
.btCommentsBox .comment-navigation a:hover:first-child:before,
.bt-comments-box .comment-navigation a:hover:first-child:before{
    -webkit-box-shadow: 0 -3em 0 {$accentColor} inset;
    box-shadow: 0 -3em 0 {$accentColor} inset;}
.btCommentsBox .comment-navigation a:hover:last-child:after,
.bt-comments-box .comment-navigation a:hover:last-child:after{
    -webkit-box-shadow: 0 -3em 0 {$accentColor} inset;
    box-shadow: 0 -3em 0 {$accentColor} inset;}
.comment-respond .comment-form > .comment-form-author span.required,
.comment-respond .comment-form > .comment-form-email span.required{
    background: {$accentColor};}
.comment-reply-title small{
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;}
.comment-reply-title small a#cancel-comment-reply-link{
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;
    background: {$accentColor};}
.btCommentSubmit{
    background: {$accentColor};
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;}
@media (max-width: 520px){.btCommentsBox ul.comments ul.children li.comment article:after,
.bt-comments-box ul.comments ul.children li.comment article:after{
    background: {$accentColor};}
}.no-comments{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.sidebar .widget_bt_bb_recent_comments ul li .posted a:before,
.btSidebar .widget_bt_bb_recent_comments ul li .posted a:before,
.bt-site-footer-widgets .widget_bt_bb_recent_comments ul li .posted a:before{
    color: {$accentColor};}
.body:not(.btNoDashInSidebar) .btBox .wp-block-group div > h1:after,
.body:not(.btNoDashInSidebar) .btBox .wp-block-group div > h2:after,
.body:not(.btNoDashInSidebar) .btBox .wp-block-group div > h3:after,
.body:not(.btNoDashInSidebar) .btBox .wp-block-group div > h4:after,
.body:not(.btNoDashInSidebar) .btBox .wp-block-group div > h5:after,
.body:not(.btNoDashInSidebar) .btBox .wp-block-group div > h6:after,
.body:not(.btNoDashInSidebar) .btBox .wp-block-group div > h7:after,
.body:not(.btNoDashInSidebar) .btBox .wp-block-group div > h8:after,
.body:not(.btNoDashInSidebar) .btCustomMenu .wp-block-group div > h1:after,
.body:not(.btNoDashInSidebar) .btCustomMenu .wp-block-group div > h2:after,
.body:not(.btNoDashInSidebar) .btCustomMenu .wp-block-group div > h3:after,
.body:not(.btNoDashInSidebar) .btCustomMenu .wp-block-group div > h4:after,
.body:not(.btNoDashInSidebar) .btCustomMenu .wp-block-group div > h5:after,
.body:not(.btNoDashInSidebar) .btCustomMenu .wp-block-group div > h6:after,
.body:not(.btNoDashInSidebar) .btCustomMenu .wp-block-group div > h7:after,
.body:not(.btNoDashInSidebar) .btCustomMenu .wp-block-group div > h8:after,
.body:not(.btNoDashInSidebar) .btTopBox .wp-block-group div > h1:after,
.body:not(.btNoDashInSidebar) .btTopBox .wp-block-group div > h2:after,
.body:not(.btNoDashInSidebar) .btTopBox .wp-block-group div > h3:after,
.body:not(.btNoDashInSidebar) .btTopBox .wp-block-group div > h4:after,
.body:not(.btNoDashInSidebar) .btTopBox .wp-block-group div > h5:after,
.body:not(.btNoDashInSidebar) .btTopBox .wp-block-group div > h6:after,
.body:not(.btNoDashInSidebar) .btTopBox .wp-block-group div > h7:after,
.body:not(.btNoDashInSidebar) .btTopBox .wp-block-group div > h8:after{
    border-bottom: 2px solid {$accentColor};}
body:not(.btNoDashInSidebar) .btBox > h4:after,
body:not(.btNoDashInSidebar) .btCustomMenu > h4:after,
body:not(.btNoDashInSidebar) .btTopBox > h4:after{
    border-bottom: 2px solid {$accentColor};}
.btBox ul li a:after,
.btBox ol.wp-block-latest-comments li a:after,
.btCustomMenu ul li a:after,
.btCustomMenu ol.wp-block-latest-comments li a:after,
.btTopBox ul li a:after,
.btTopBox ol.wp-block-latest-comments li a:after{
    background: {$accentColor};}
.btBox ul li a:hover,
.btBox ol.wp-block-latest-comments li a:hover,
.btCustomMenu ul li a:hover,
.btCustomMenu ol.wp-block-latest-comments li a:hover,
.btTopBox ul li a:hover,
.btTopBox ol.wp-block-latest-comments li a:hover{color: {$accentColor};}
.btBox ul li.current-menu-item > a,
.btBox ol.wp-block-latest-comments li.current-menu-item > a,
.btCustomMenu ul li.current-menu-item > a,
.btCustomMenu ol.wp-block-latest-comments li.current-menu-item > a,
.btTopBox ul li.current-menu-item > a,
.btTopBox ol.wp-block-latest-comments li.current-menu-item > a{color: {$accentColor};}
.btBox .btImageTextWidget .btImageTextWidgetImage a:before,
.btCustomMenu .btImageTextWidget .btImageTextWidgetImage a:before,
.btTopBox .btImageTextWidget .btImageTextWidgetImage a:before{
    background: {$accentColor};}
.widget_calendar table caption{font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;
    background: {$accentColor};}
.widget_calendar table thead th{
    background-color: {$accentColor};}
.widget_calendar table tbody tr td#today{color: {$accentColor};}
.widget_calendar table tbody td a{
    background: {$accentColor};}
.widget_recent_comments ul .recentcomments .comment-author-link a:before{
    color: {$accentColor};}
.wp-block-latest-comments li a[class*=\"comment-author\"]:before{
    color: {$accentColor};}
.widget_rss li a.rsswidget{font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.widget_rss li .rss-date:before{
    color: {$accentColor};}
.widget_shopping_cart .widget_shopping_cart_content .mini_cart_item .ppRemove a.remove{
    background-color: {$accentColor};}
.menuPort .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetIcon:hover,
.topTools .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetIcon:hover,
.topBarInLogoArea .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetIcon:hover{color: {$accentColor};}
.btMenuVertical .menuPort .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetInnerContent .verticalMenuCartToggler,
.btMenuVertical .topTools .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetInnerContent .verticalMenuCartToggler,
.btMenuVertical .topBarInLogoArea .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetInnerContent .verticalMenuCartToggler{
    background: {$accentColor};}
.btMenuHorizontal .topBarInMenu .widget_shopping_cart .widget_shopping_cart_content{line-height: -webkit-calc({$logoHeight}px*0.6);
    line-height: -moz-calc({$logoHeight}px*0.6);
    line-height: calc({$logoHeight}px*0.6);
    line-height: max(50px,-webkit-calc({$logoHeight}px*0.6));
    line-height: max(50px,-moz-calc({$logoHeight}px*0.6));
    line-height: max(50px,calc({$logoHeight}px*0.6));}
.btMenuHorizontal .topBarInMenu .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetInnerContent{top: -webkit-calc({$logoHeight}px*0.6);
    top: -moz-calc({$logoHeight}px*0.6);
    top: calc({$logoHeight}px*0.6);
    top: max(50px,-webkit-calc({$logoHeight}px*0.6));
    top: max(50px,-moz-calc({$logoHeight}px*0.6));
    top: max(50px,calc({$logoHeight}px*0.6));}
.widget_recent_reviews{font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.widget_price_filter .price_slider_wrapper .ui-slider .ui-slider-handle{
    background-color: {$accentColor};}
.btBox .tagcloud a:hover,
.btTags ul a:hover{
    background: {$accentColor};}
.topTools a.btIconWidget:hover,
.topBarInMenu a.btIconWidget:hover{color: {$accentColor};}
.btAccentIconWidget.btIconWidget .btIconWidgetIcon{color: {$accentColor};}
a.btAccentIconWidget.btIconWidget:hover{color: {$accentColor};}
.btAlternateIconWidget.btIconWidget .btIconWidgetIcon{color: {$alternateColor};}
a.btAlternateIconWidget.btIconWidget:hover{color: {$alternateColor};}
.bt-site-footer-widgets .btSearch button,
.bt-site-footer-widgets .btSearch input[type=submit],
.btSidebar .btSearch button,
.btSidebar .btSearch input[type=submit],
.btSidebar .widget_product_search button,
.btSidebar .widget_product_search input[type=submit]{
    background: {$accentColor} !important;}
.bt-site-footer-widgets .wp-block-search .wp-block-search__button,
.btSidebar .wp-block-search .wp-block-search__button{
    background: {$accentColor} !important;}
.btSearchInner.btFromTopBox .btSearchInnerClose .bt_bb_icon .bt_bb_icon_holder:hover{background: {$accentColor} !important;}
.btSearchInner.btFromTopBox form button{
    background: {$accentColor};}
.bt_bb_separator.bt_bb_border_color_accent{border-bottom-color: {$accentColor};}
.bt_bb_separator.bt_bb_border_color_alternate{border-bottom-color: {$alternateColor};}
.bt_bb_headline .bt_bb_headline_superheadline_outside{font-family: \"{$headingSuperTitleFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_headline .bt_bb_headline_superheadline{
    font-family: \"{$headingSuperTitleFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_headline.bt_bb_subheadline .bt_bb_headline_subheadline{font-family: \"{$headingSubTitleFont}\",Arial,Helvetica,sans-serif;}
.btHasBgImage.bt_bb_headline h1 .bt_bb_headline_content span,
.btHasBgImage.bt_bb_headline h2 .bt_bb_headline_content span,
.btHasBgImage.bt_bb_headline h3 .bt_bb_headline_content span,
.btHasBgImage.bt_bb_headline h4 .bt_bb_headline_content span,
.btHasBgImage.bt_bb_headline h5 .bt_bb_headline_content span,
.btHasBgImage.bt_bb_headline h6 .bt_bb_headline_content span{
    background-color: {$accentColor};}
.bt_bb_headline h1 .bt_bb_headline_content b,
.bt_bb_headline h2 .bt_bb_headline_content b,
.bt_bb_headline h3 .bt_bb_headline_content b,
.bt_bb_headline h4 .bt_bb_headline_content b,
.bt_bb_headline h5 .bt_bb_headline_content b,
.bt_bb_headline h6 .bt_bb_headline_content b{color: {$accentColor};}
.bt_bb_headline h1 .bt_bb_headline_content u,
.bt_bb_headline h2 .bt_bb_headline_content u,
.bt_bb_headline h3 .bt_bb_headline_content u,
.bt_bb_headline h4 .bt_bb_headline_content u,
.bt_bb_headline h5 .bt_bb_headline_content u,
.bt_bb_headline h6 .bt_bb_headline_content u{color: {$alternateColor};}
.bt_bb_dash_top.bt_bb_headline h1 .bt_bb_headline_content:before,
.bt_bb_dash_top_bottom.bt_bb_headline h1 .bt_bb_headline_content:before,
.bt_bb_dash_bottom.bt_bb_headline h1 .bt_bb_headline_content:before,
.bt_bb_dash_top.bt_bb_headline h1 .bt_bb_headline_content:after,
.bt_bb_dash_top_bottom.bt_bb_headline h1 .bt_bb_headline_content:after,
.bt_bb_dash_bottom.bt_bb_headline h1 .bt_bb_headline_content:after,
.bt_bb_dash_top.bt_bb_headline h2 .bt_bb_headline_content:before,
.bt_bb_dash_top_bottom.bt_bb_headline h2 .bt_bb_headline_content:before,
.bt_bb_dash_bottom.bt_bb_headline h2 .bt_bb_headline_content:before,
.bt_bb_dash_top.bt_bb_headline h2 .bt_bb_headline_content:after,
.bt_bb_dash_top_bottom.bt_bb_headline h2 .bt_bb_headline_content:after,
.bt_bb_dash_bottom.bt_bb_headline h2 .bt_bb_headline_content:after,
.bt_bb_dash_top.bt_bb_headline h3 .bt_bb_headline_content:before,
.bt_bb_dash_top_bottom.bt_bb_headline h3 .bt_bb_headline_content:before,
.bt_bb_dash_bottom.bt_bb_headline h3 .bt_bb_headline_content:before,
.bt_bb_dash_top.bt_bb_headline h3 .bt_bb_headline_content:after,
.bt_bb_dash_top_bottom.bt_bb_headline h3 .bt_bb_headline_content:after,
.bt_bb_dash_bottom.bt_bb_headline h3 .bt_bb_headline_content:after,
.bt_bb_dash_top.bt_bb_headline h4 .bt_bb_headline_content:before,
.bt_bb_dash_top_bottom.bt_bb_headline h4 .bt_bb_headline_content:before,
.bt_bb_dash_bottom.bt_bb_headline h4 .bt_bb_headline_content:before,
.bt_bb_dash_top.bt_bb_headline h4 .bt_bb_headline_content:after,
.bt_bb_dash_top_bottom.bt_bb_headline h4 .bt_bb_headline_content:after,
.bt_bb_dash_bottom.bt_bb_headline h4 .bt_bb_headline_content:after,
.bt_bb_dash_top.bt_bb_headline h5 .bt_bb_headline_content:before,
.bt_bb_dash_top_bottom.bt_bb_headline h5 .bt_bb_headline_content:before,
.bt_bb_dash_bottom.bt_bb_headline h5 .bt_bb_headline_content:before,
.bt_bb_dash_top.bt_bb_headline h5 .bt_bb_headline_content:after,
.bt_bb_dash_top_bottom.bt_bb_headline h5 .bt_bb_headline_content:after,
.bt_bb_dash_bottom.bt_bb_headline h5 .bt_bb_headline_content:after,
.bt_bb_dash_top.bt_bb_headline h6 .bt_bb_headline_content:before,
.bt_bb_dash_top_bottom.bt_bb_headline h6 .bt_bb_headline_content:before,
.bt_bb_dash_bottom.bt_bb_headline h6 .bt_bb_headline_content:before,
.bt_bb_dash_top.bt_bb_headline h6 .bt_bb_headline_content:after,
.bt_bb_dash_top_bottom.bt_bb_headline h6 .bt_bb_headline_content:after,
.bt_bb_dash_bottom.bt_bb_headline h6 .bt_bb_headline_content:after{
    background: {$accentColor};}
.bt_bb_dash_color_alternate.bt_bb_dash_top.bt_bb_headline h1 .bt_bb_headline_content:before,
.bt_bb_dash_color_alternate.bt_bb_dash_top_bottom.bt_bb_headline h1 .bt_bb_headline_content:before,
.bt_bb_dash_color_alternate.bt_bb_dash_bottom.bt_bb_headline h1 .bt_bb_headline_content:before,
.bt_bb_dash_color_alternate.bt_bb_dash_top.bt_bb_headline h1 .bt_bb_headline_content:after,
.bt_bb_dash_color_alternate.bt_bb_dash_top_bottom.bt_bb_headline h1 .bt_bb_headline_content:after,
.bt_bb_dash_color_alternate.bt_bb_dash_bottom.bt_bb_headline h1 .bt_bb_headline_content:after,
.bt_bb_dash_color_alternate.bt_bb_dash_top.bt_bb_headline h2 .bt_bb_headline_content:before,
.bt_bb_dash_color_alternate.bt_bb_dash_top_bottom.bt_bb_headline h2 .bt_bb_headline_content:before,
.bt_bb_dash_color_alternate.bt_bb_dash_bottom.bt_bb_headline h2 .bt_bb_headline_content:before,
.bt_bb_dash_color_alternate.bt_bb_dash_top.bt_bb_headline h2 .bt_bb_headline_content:after,
.bt_bb_dash_color_alternate.bt_bb_dash_top_bottom.bt_bb_headline h2 .bt_bb_headline_content:after,
.bt_bb_dash_color_alternate.bt_bb_dash_bottom.bt_bb_headline h2 .bt_bb_headline_content:after,
.bt_bb_dash_color_alternate.bt_bb_dash_top.bt_bb_headline h3 .bt_bb_headline_content:before,
.bt_bb_dash_color_alternate.bt_bb_dash_top_bottom.bt_bb_headline h3 .bt_bb_headline_content:before,
.bt_bb_dash_color_alternate.bt_bb_dash_bottom.bt_bb_headline h3 .bt_bb_headline_content:before,
.bt_bb_dash_color_alternate.bt_bb_dash_top.bt_bb_headline h3 .bt_bb_headline_content:after,
.bt_bb_dash_color_alternate.bt_bb_dash_top_bottom.bt_bb_headline h3 .bt_bb_headline_content:after,
.bt_bb_dash_color_alternate.bt_bb_dash_bottom.bt_bb_headline h3 .bt_bb_headline_content:after,
.bt_bb_dash_color_alternate.bt_bb_dash_top.bt_bb_headline h4 .bt_bb_headline_content:before,
.bt_bb_dash_color_alternate.bt_bb_dash_top_bottom.bt_bb_headline h4 .bt_bb_headline_content:before,
.bt_bb_dash_color_alternate.bt_bb_dash_bottom.bt_bb_headline h4 .bt_bb_headline_content:before,
.bt_bb_dash_color_alternate.bt_bb_dash_top.bt_bb_headline h4 .bt_bb_headline_content:after,
.bt_bb_dash_color_alternate.bt_bb_dash_top_bottom.bt_bb_headline h4 .bt_bb_headline_content:after,
.bt_bb_dash_color_alternate.bt_bb_dash_bottom.bt_bb_headline h4 .bt_bb_headline_content:after,
.bt_bb_dash_color_alternate.bt_bb_dash_top.bt_bb_headline h5 .bt_bb_headline_content:before,
.bt_bb_dash_color_alternate.bt_bb_dash_top_bottom.bt_bb_headline h5 .bt_bb_headline_content:before,
.bt_bb_dash_color_alternate.bt_bb_dash_bottom.bt_bb_headline h5 .bt_bb_headline_content:before,
.bt_bb_dash_color_alternate.bt_bb_dash_top.bt_bb_headline h5 .bt_bb_headline_content:after,
.bt_bb_dash_color_alternate.bt_bb_dash_top_bottom.bt_bb_headline h5 .bt_bb_headline_content:after,
.bt_bb_dash_color_alternate.bt_bb_dash_bottom.bt_bb_headline h5 .bt_bb_headline_content:after,
.bt_bb_dash_color_alternate.bt_bb_dash_top.bt_bb_headline h6 .bt_bb_headline_content:before,
.bt_bb_dash_color_alternate.bt_bb_dash_top_bottom.bt_bb_headline h6 .bt_bb_headline_content:before,
.bt_bb_dash_color_alternate.bt_bb_dash_bottom.bt_bb_headline h6 .bt_bb_headline_content:before,
.bt_bb_dash_color_alternate.bt_bb_dash_top.bt_bb_headline h6 .bt_bb_headline_content:after,
.bt_bb_dash_color_alternate.bt_bb_dash_top_bottom.bt_bb_headline h6 .bt_bb_headline_content:after,
.bt_bb_dash_color_alternate.bt_bb_dash_bottom.bt_bb_headline h6 .bt_bb_headline_content:after{background: {$alternateColor};}
.bt_bb_dash_behind.bt_bb_headline:before{
    border-color: {$accentColor};}
.bt_bb_dash_color_alternate.bt_bb_dash_behind.bt_bb_headline:before{border-color: {$alternateColor};}
.bt_bb_style_filled.bt_bb_icon .bt_bb_icon_holder:before,
.bt_bb_style_filled.bt_bb_icon:hover .bt_bb_icon_holder:before{
    background: {$accentColor};}
.bt_bb_style_outline.bt_bb_icon .bt_bb_icon_holder:before,
.bt_bb_style_outline.bt_bb_icon:hover .bt_bb_icon_holder:before{-webkit-box-shadow: 0 0 0 2px {$accentColor} inset;
    box-shadow: 0 0 0 2px {$accentColor} inset;
    color: {$accentColor};}
.bt_bb_style_outline.bt_bb_icon:hover a.bt_bb_icon_holder:before{-webkit-box-shadow: 0 0 0 2px {$accentColor} inset,0 5px 20px rgba(0,0,0,.2);
    box-shadow: 0 0 0 2px {$accentColor} inset,0 5px 20px rgba(0,0,0,.2);
    color: {$accentColor};}
.bt_bb_style_borderless.bt_bb_icon:hover a.bt_bb_icon_holder:before{color: {$accentColor};}
.bt_bb_button{font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_service .bt_bb_service_content .bt_bb_service_content_title{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_service .bt_bb_service_content .bt_bb_service_content_title b{color: {$accentColor};}
.bt_bb_service .bt_bb_service_content .bt_bb_service_content_title u{color: {$alternateColor};}
.bt_bb_service .bt_bb_service_content .bt_bb_service_content_title a:hover{color: {$accentColor};}
.bt_bb_style_filled.bt_bb_service > .bt_bb_icon_holder{
    background: {$accentColor};}
:hover.bt_bb_style_filled.bt_bb_service > .bt_bb_icon_holder{
    background: {$accentColor};}
.bt_bb_style_outline.bt_bb_service > .bt_bb_icon_holder{-webkit-box-shadow: 0 0 0 2px {$accentColor};
    box-shadow: 0 0 0 2px {$accentColor};
    color: {$accentColor};}
:hover.bt_bb_style_outline.bt_bb_service > .bt_bb_icon_holder{-webkit-box-shadow: 0 0 0 2px {$accentColor};
    box-shadow: 0 0 0 2px {$accentColor};
    color: {$accentColor};}
.bt_bb_style_outline.bt_bb_service > .bt_bb_icon_holder:hover{-webkit-box-shadow: 0 0 0 2px {$accentColor},0 5px 20px rgba(0,0,0,.2);
    box-shadow: 0 0 0 2px {$accentColor},0 5px 20px rgba(0,0,0,.2);}
.bt_bb_service .bt_bb_grid_item_read_more a{
    color: {$accentColor};}
.bt_bb_service .bt_bb_grid_item_read_more a .bt_bb_grid_item_icon{
    background: {$accentColor};}
button.slick-arrow{
    font-family: \"{$bodyFont}\",Arial,Helvetica,sans-serif;}
.slick-dots li.slick-active button:after{
    background: {$accentColor};}
.bt_bb_active_dot_color_accent .slick-dots li.slick-active button:after{background: {$accentColor};}
.bt_bb_active_dot_color_alternate .slick-dots li.slick-active button:after{background: {$alternateColor};}
.bt_bb_style_simple ul.bt_bb_tabs_header li span:after{
    background: {$accentColor};}
.bt_bb_style_simple.bt_bb_accordion .bt_bb_accordion_item .bt_bb_accordion_item_title:before{
    background-color: {$accentColor};}
.btCounterHolder{font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.btCounterHolder .btCountdownHolder span[class$=\"_text\"]{font-family: \"{$bodyFont}\",Arial,Helvetica,sans-serif;}
.btCountDownAccentNumbers.btCounterHolder .btCountdownHolder span[class^=\"n\"],
.btCountDownAccentNumbers.btCounterHolder .btCountdownHolder .days > span:first-child,
.btCountDownAccentNumbers.btCounterHolder .btCountdownHolder .days > span:nth-child(2),
.btCountDownAccentNumbers.btCounterHolder .btCountdownHolder .days > span:nth-child(3){color: {$accentColor};}
.bt_bb_price_list .bt_bb_price_list_title{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_price_list .bt_bb_price_list_price{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_latest_posts .bt_bb_latest_posts_item .bt_bb_latest_posts_item_content .bt_bb_latest_posts_item_meta span.bt_bb_latest_posts_item_author:before{
    color: {$accentColor};}
.bt_bb_latest_posts .bt_bb_latest_posts_item .bt_bb_latest_posts_item_content .bt_bb_latest_posts_item_meta span.bt_bb_latest_posts_item_comments:before{
    color: {$accentColor};}
button.mfp-close:hover{background: {$accentColor} !important;}
.bt_bb_back_to_top .bt_back_to_top_button{background: {$accentColor};}
.bt_bb_back_to_top_alternate.bt_bb_back_to_top .bt_back_to_top_button{background: {$alternateColor};}
.bt_bb_back_to_top .bt_back_to_top_button_no_icon{
    background: {$accentColor};}
.bt_bb_back_to_top_alternate.bt_bb_back_to_top .bt_back_to_top_button_no_icon{background: {$alternateColor};}
.bt_bb_back_to_top .bt_bb_back_to_top_text{
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_portfolio_slider .bt_bb_grid_item .bt_bb_grid_item_inner .bt_bb_grid_item_meta span.bt_bb_grid_item_author:before,
.bt_bb_post_slider .bt_bb_grid_item .bt_bb_grid_item_inner .bt_bb_grid_item_meta span.bt_bb_grid_item_author:before{
    color: {$accentColor};}
.bt_bb_portfolio_slider .bt_bb_grid_item .bt_bb_grid_item_inner .bt_bb_grid_item_meta span.bt_bb_grid_item_comments:before,
.bt_bb_post_slider .bt_bb_grid_item .bt_bb_grid_item_inner .bt_bb_grid_item_meta span.bt_bb_grid_item_comments:before{
    color: {$accentColor};}
.bt_bb_post_grid_loader:after{
    background: {$accentColor};}
.bt_bb_post_grid_filter .bt_bb_post_grid_filter_item{
    font-family: \"{$menuFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_post_grid_filter .bt_bb_post_grid_filter_item:before{
    background: {$accentColor};}
.bt_bb_masonry_post_grid .bt_bb_grid_item .bt_bb_grid_item_inner .bt_bb_grid_item_meta span.bt_bb_grid_item_author:before,
.bt_bb_masonry_portfolio_grid .bt_bb_grid_item .bt_bb_grid_item_inner .bt_bb_grid_item_meta span.bt_bb_grid_item_author:before{
    color: {$accentColor};}
.bt_bb_masonry_post_grid .bt_bb_grid_item .bt_bb_grid_item_inner .bt_bb_grid_item_meta span.bt_bb_grid_item_comments:before,
.bt_bb_masonry_portfolio_grid .bt_bb_grid_item .bt_bb_grid_item_inner .bt_bb_grid_item_meta span.bt_bb_grid_item_comments:before{
    color: {$accentColor};}
.btWorkingHours .btWorkingHoursInner .bt_bb_working_hours_inner_row .bt_bb_working_hours_inner_wrapper .bt_bb_working_hours_inner_link a{
    background: {$accentColor};
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_cost_calculator .bt_bb_cost_calculator_total{background: {$accentColor};}
.bt_bb_widget_select_items > div[data-value]:before{
    background: {$accentColor};}
.bt_bb_widget_select_items > div[data-value]:hover{color: {$accentColor};}
.on.bt_bb_widget_switch > div{background: {$accentColor};}
div.wpcf7 .ajax-loader:after,
div.wpcf7 .wpcf7-spinner:after{
    background: {$accentColor};}
.wpcf7-form .wpcf7-submit:not([type='checkbox']):not([type='radio']){
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;
    background: {$accentColor};}
.bt_bb_submit_button_style_alternate .wpcf7-form .wpcf7-submit:not([type='checkbox']):not([type='radio']){background: {$alternateColor};}
.bt_bb_submit_button_style_alternate .wpcf7-form input[type=\"file\"]::-webkit-file-upload-button{background: {$alternateColor} !important;}
div.wpcf7-validation-errors,
div.wpcf7-acceptance-missing{border: 2px solid {$accentColor};}
span.wpcf7-not-valid-tip{color: {$accentColor};}
.products ul li.product .btWooShopLoopItemInner .bt_bb_headline .bt_bb_headline_content a:hover,
ul.products li.product .btWooShopLoopItemInner .bt_bb_headline .bt_bb_headline_content a:hover{color: {$accentColor};}
.products ul li.product .btWooShopLoopItemInner .bt_bb_headline .bt_bb_headline_subheadline .star-rating span:before,
ul.products li.product .btWooShopLoopItemInner .bt_bb_headline .bt_bb_headline_subheadline .star-rating span:before{color: {$accentColor};}
.products ul li.product .btWooShopLoopItemInner .added_to_cart:hover:before,
ul.products li.product .btWooShopLoopItemInner .added_to_cart:hover:before{
    background: {$accentColor};}
.products ul li.product .onsale:before,
ul.products li.product .onsale:before{
    background: {$alternateColor};}
.products ul li.product .onsale:after,
ul.products li.product .onsale:after{
    border-color: {$alternateColor} transparent transparent transparent;}
.rtl .products ul li.product .onsale:after,
.rtl ul.products li.product .onsale:after{
    border-color: transparent {$alternateColor} transparent transparent;}
nav.woocommerce-pagination ul li a:focus,
nav.woocommerce-pagination ul li a:hover,
nav.woocommerce-pagination ul li a.next:hover,
nav.woocommerce-pagination ul li a.prev:hover{
    background: {$accentColor};}
div.product > .onsale:before{
    background: {$alternateColor};}
div.product > .onsale:after{
    border-color: transparent {$alternateColor} transparent transparent;}
.rtl div.product > .onsale:after{
    border-color: {$alternateColor} transparent transparent transparent;}
div.product div.images .woocommerce-product-gallery__trigger{
    background: {$accentColor};}
div.product div.summary form.cart .group_table a{font-family: \"{$headingFont}\",Arial,Helvetica;}
div.product div.summary form.cart .group_table a:hover{color: {$accentColor} !important;}
div.product div.summary form.cart .single_add_to_cart_button{
    background: {$accentColor} !important;}
ul.wc_payment_methods li.payment_method_paypal .about_paypal{
    color: {$accentColor};
    -webkit-box-shadow: 0 1px 0 0 {$accentColor};
    box-shadow: 0 1px 0 0 {$accentColor};}
ul.wc_payment_methods li.payment_method_paypal .about_paypal:hover{-webkit-box-shadow: 0 0 0 0 {$accentColor};
    box-shadow: 0 0 0 0 {$accentColor};}
.woocommerce-MyAccount-navigation ul li{
    font-family: \"{$menuFont}\",Arial,Helvetica,sans-serif;}
.woocommerce-MyAccount-navigation ul li a:after{
    background: {$accentColor};}
.reset_variations{
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;
    background: {$accentColor};}
table.shop_table td.woocommerce-orders-table__cell-order-number a:hover{
    background: {$accentColor};}
table.shop_table td.product-remove a.remove{
    background-color: {$accentColor};}
table.shop_table td.product-thumbnail a:before{
    background: {$accentColor};}
table.shop_table .product-name > a{font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
table.shop_table .product-name > a:hover{color: {$accentColor} !important;}
tr.cart-subtotal,
tfoot{border-top: 2px solid {$accentColor};}
tr.order-total,
tfoot{border-bottom: 2px solid {$accentColor} !important;}
form fieldset legend{
    font-family: {$headingFont},Arial,Helvetica,sans-serif;}
form .form-row .required{
    background: {$accentColor};}
form .form-row.woocommerce-invalid .select2-container,
form .form-row.woocommerce-invalid input.input-text,
form .form-row.woocommerce-invalid select{-webkit-box-shadow: 0 0 0 2px {$accentColor} inset;
    box-shadow: 0 0 0 2px {$accentColor} inset;}
.woocommerce-error:before,
.woocommerce-info:before,
.woocommerce-message:before{
    background: {$accentColor};}
.woocommerce-info a:not(.button),
.woocommerce-message a:not(.button){color: {$accentColor};}
.woocommerce-info a.showcoupon,
.woocommerce-message a.showcoupon{font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;}
.woocommerce-info a.showcoupon:hover,
.woocommerce-message a.showcoupon:hover{
    background: {$accentColor};}
.woocommerce-error:after{-webkit-box-shadow: 0 0 0 4px {$accentColor} inset;
    box-shadow: 0 0 0 4px {$accentColor} inset;}
.woocommerce .btSidebar a.button,
.woocommerce .bt-content a.button,
.woocommerce-page .btSidebar a.button,
.woocommerce-page .bt-content a.button,
.woocommerce .btSidebar input[type=\"submit\"],
.woocommerce .bt-content input[type=\"submit\"],
.woocommerce-page .btSidebar input[type=\"submit\"],
.woocommerce-page .bt-content input[type=\"submit\"],
.woocommerce .btSidebar button[type=\"submit\"],
.woocommerce .bt-content button[type=\"submit\"],
.woocommerce-page .btSidebar button[type=\"submit\"],
.woocommerce-page .bt-content button[type=\"submit\"],
.woocommerce .btSidebar :not(.widget_product_search) button[type=\"submit\"],
.woocommerce .bt-content :not(.widget_product_search) button[type=\"submit\"],
.woocommerce-page .btSidebar :not(.widget_product_search) button[type=\"submit\"],
.woocommerce-page .bt-content :not(.widget_product_search) button[type=\"submit\"],
.woocommerce .btSidebar input.button,
.woocommerce .bt-content input.button,
.woocommerce-page .btSidebar input.button,
.woocommerce-page .bt-content input.button,
div.woocommerce a.button,
div.woocommerce input[type=\"submit\"],
div.woocommerce button[type=\"submit\"],
div.woocommerce :not(.widget_product_search) button[type=\"submit\"],
div.woocommerce input.button{
    background: {$accentColor};
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;}
.woocommerce .btSidebar input.alt,
.woocommerce .bt-content input.alt,
.woocommerce-page .btSidebar input.alt,
.woocommerce-page .bt-content input.alt,
.woocommerce .btSidebar a.button.alt,
.woocommerce .bt-content a.button.alt,
.woocommerce-page .btSidebar a.button.alt,
.woocommerce-page .bt-content a.button.alt,
.woocommerce .btSidebar .button.alt,
.woocommerce .bt-content .button.alt,
.woocommerce-page .btSidebar .button.alt,
.woocommerce-page .bt-content .button.alt,
.woocommerce .btSidebar button.alt,
.woocommerce .bt-content button.alt,
.woocommerce-page .btSidebar button.alt,
.woocommerce-page .bt-content button.alt,
.woocommerce .btSidebar .shipping-calculator-button,
.woocommerce .bt-content .shipping-calculator-button,
.woocommerce-page .btSidebar .shipping-calculator-button,
.woocommerce-page .bt-content .shipping-calculator-button,
div.woocommerce input.alt,
div.woocommerce a.button.alt,
div.woocommerce .button.alt,
div.woocommerce button.alt,
div.woocommerce .shipping-calculator-button{
    color: {$alternateColor};
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;
    -webkit-box-shadow: 0 0 0 2px {$alternateColor} inset,0 0 0 rgba(0,0,0,.2);
    box-shadow: 0 0 0 2px {$alternateColor} inset,0 0 0 rgba(0,0,0,.2);}
.woocommerce .btSidebar input.alt:hover,
.woocommerce .bt-content input.alt:hover,
.woocommerce-page .btSidebar input.alt:hover,
.woocommerce-page .bt-content input.alt:hover,
.woocommerce .btSidebar a.button.alt:hover,
.woocommerce .bt-content a.button.alt:hover,
.woocommerce-page .btSidebar a.button.alt:hover,
.woocommerce-page .bt-content a.button.alt:hover,
.woocommerce .btSidebar .button.alt:hover,
.woocommerce .bt-content .button.alt:hover,
.woocommerce-page .btSidebar .button.alt:hover,
.woocommerce-page .bt-content .button.alt:hover,
.woocommerce .btSidebar button.alt:hover,
.woocommerce .bt-content button.alt:hover,
.woocommerce-page .btSidebar button.alt:hover,
.woocommerce-page .bt-content button.alt:hover,
.woocommerce .btSidebar .shipping-calculator-button:hover,
.woocommerce .bt-content .shipping-calculator-button:hover,
.woocommerce-page .btSidebar .shipping-calculator-button:hover,
.woocommerce-page .bt-content .shipping-calculator-button:hover,
div.woocommerce input.alt:hover,
div.woocommerce a.button.alt:hover,
div.woocommerce .button.alt:hover,
div.woocommerce button.alt:hover,
div.woocommerce .shipping-calculator-button:hover{-webkit-box-shadow: 0 0 0 2px {$alternateColor} inset,0 5px 20px rgba(0,0,0,.2);
    box-shadow: 0 0 0 2px {$alternateColor} inset,0 5px 20px rgba(0,0,0,.2);}
.woocommerce .btSidebar a.edit:hover,
.woocommerce .bt-content a.edit:hover,
.woocommerce-page .btSidebar a.edit:hover,
.woocommerce-page .bt-content a.edit:hover,
div.woocommerce a.edit:hover{
    background: {$accentColor};}
.star-rating span:before{
    color: {$accentColor};}
p.stars a[class^=\"star-\"].active:after,
p.stars a[class^=\"star-\"]:hover:after{color: {$accentColor};}
.select2-container--default .select2-results__option--highlighted[aria-selected],
.select2-container--default .select2-results__option--highlighted[data-selected]{background-color: {$accentColor};}
.pswp__top-bar .pswp__button:hover{background: {$accentColor} !important;}
.select2-container .select2-dropdown .select2-results__option:after{
    background: {$accentColor};}
.select2-container .select2-dropdown .select2-results__option[aria-selected=\"true\"]{color: {$accentColor};}
mark.order-status{background: {$accentColor} !important;}
.woocommerce-MyAccount-content a{-webkit-box-shadow: 0 1px 0 0 {$accentColor};
    box-shadow: 0 1px 0 0 {$accentColor};}
.woocommerce-MyAccount-content a:hover{-webkit-box-shadow: 0 0 0 0 {$accentColor};
    box-shadow: 0 0 0 0 {$accentColor};}
.woocommerce-noreviews{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.btQuoteBooking .btQuoteSwitch.on .btQuoteSwitchInner{background: {$accentColor};}
.btQuoteBooking .ui-slider.ui-slider-horizontal .ui-slider-handle{
    background: {$accentColor};}
.btQuoteBooking .ddChild ul li:before{
    background: {$accentColor};}
.btQuoteBooking .ddChild ul li.hover{color: {$accentColor};}
.btQuoteBooking .btQuoteBookingForm .btQuoteTotal{background: {$accentColor};}
.btQuoteBooking .btContactNext{background: {$accentColor};
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif !important;}
.btQuoteBooking .btQuoteContact .boldBtn .btContactSubmit{background: {$accentColor} !important;
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif !important;}
.btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"text\"],
.btDarkSkin .btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"text\"],
.btLightSkin .btDarkSkin .btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"text\"],
.btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"text\"],
.btLightSkin .btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"text\"],
.btDarkSkin.btLightSkin .btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"text\"],
.btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"email\"],
.btDarkSkin .btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"email\"],
.btLightSkin .btDarkSkin .btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"email\"],
.btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"email\"],
.btLightSkin .btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"email\"],
.btDarkSkin.btLightSkin .btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"email\"],
.btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"password\"],
.btDarkSkin .btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"password\"],
.btLightSkin .btDarkSkin .btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"password\"],
.btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"password\"],
.btLightSkin .btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"password\"],
.btDarkSkin.btLightSkin .btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"password\"],
.btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"url\"],
.btDarkSkin .btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"url\"],
.btLightSkin .btDarkSkin .btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"url\"],
.btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"url\"],
.btLightSkin .btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"url\"],
.btDarkSkin.btLightSkin .btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"url\"],
.btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"tel\"],
.btDarkSkin .btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"tel\"],
.btLightSkin .btDarkSkin .btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"tel\"],
.btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"tel\"],
.btLightSkin .btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"tel\"],
.btDarkSkin.btLightSkin .btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"tel\"],
.btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"number\"],
.btDarkSkin .btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"number\"],
.btLightSkin .btDarkSkin .btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"number\"],
.btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"number\"],
.btLightSkin .btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"number\"],
.btDarkSkin.btLightSkin .btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"number\"],
.btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"date\"],
.btDarkSkin .btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"date\"],
.btLightSkin .btDarkSkin .btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"date\"],
.btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"date\"],
.btLightSkin .btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"date\"],
.btDarkSkin.btLightSkin .btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError input[type=\"date\"],
.btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError textarea,
.btDarkSkin .btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError textarea,
.btLightSkin .btDarkSkin .btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError textarea,
.btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError textarea,
.btLightSkin .btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError textarea,
.btDarkSkin.btLightSkin .btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError textarea,
.btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError .dd.ddcommon.borderRadius .ddTitleText,
.btDarkSkin .btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError .dd.ddcommon.borderRadius .ddTitleText,
.btLightSkin .btDarkSkin .btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError .dd.ddcommon.borderRadius .ddTitleText,
.btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError .dd.ddcommon.borderRadius .ddTitleText,
.btLightSkin .btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError .dd.ddcommon.borderRadius .ddTitleText,
.btDarkSkin.btLightSkin .btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError .dd.ddcommon.borderRadius .ddTitleText,
.btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError .dd.ddcommon.borderRadiusTp .ddTitleText,
.btDarkSkin .btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError .dd.ddcommon.borderRadiusTp .ddTitleText,
.btLightSkin .btDarkSkin .btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError .dd.ddcommon.borderRadiusTp .ddTitleText,
.btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError .dd.ddcommon.borderRadiusTp .ddTitleText,
.btLightSkin .btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError .dd.ddcommon.borderRadiusTp .ddTitleText,
.btDarkSkin.btLightSkin .btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError .dd.ddcommon.borderRadiusTp .ddTitleText,
.btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError .dd.ddcommon.borderRadiusBtm .ddTitleText,
.btDarkSkin .btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError .dd.ddcommon.borderRadiusBtm .ddTitleText,
.btLightSkin .btDarkSkin .btLightSkin .btQuoteBooking .btQuoteContact .btContactFieldError .dd.ddcommon.borderRadiusBtm .ddTitleText,
.btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError .dd.ddcommon.borderRadiusBtm .ddTitleText,
.btLightSkin .btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError .dd.ddcommon.borderRadiusBtm .ddTitleText,
.btDarkSkin.btLightSkin .btDarkSkin .btQuoteBooking .btQuoteContact .btContactFieldError .dd.ddcommon.borderRadiusBtm .ddTitleText{-webkit-box-shadow: 0 0 0 2px {$accentColor} inset !important;
    box-shadow: 0 0 0 2px {$accentColor} inset !important;}
.btQuoteBooking .bt_cc_email_confirmation_container input[type=\"checkbox\"]:after{
    color: {$accentColor};}
.btQuoteBooking .btSubmitMessage{color: {$accentColor};}
.btDatePicker .ui-datepicker-header{background: {$accentColor};}
.bt_bb_progress_bar_advanced .progressbar-text{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_testimonial .btReviewStars .star-rating span:before{color: {$accentColor};}
.bt_bb_star_color_accent.bt_bb_testimonial .btReviewStars .star-rating span:before{color: {$accentColor};}
.bt_bb_star_color_alternate.bt_bb_testimonial .btReviewStars .star-rating span:before{color: {$alternateColor};}
.bt_bb_line_color_accent.bt_bb_process .bt_bb_process_step:after,
.bt_bb_line_color_accent.bt_bb_process .bt_bb_process_step:before{border-color: {$accentColor} !important;}
.bt_bb_line_color_alternate.bt_bb_process .bt_bb_process_step:after,
.bt_bb_line_color_alternate.bt_bb_process .bt_bb_process_step:before{border-color: {$alternateColor} !important;}
.bt_bb_process .bt_bb_process_step .bt_bb_process_step_icon .bt_bb_icon_holder{
    background: {$accentColor};}
.bt_bb_process .bt_bb_process_step:hover .bt_bb_process_step_content .bt_bb_process_step_title{color: {$accentColor};}
.bt_bb_bulleted_list .bt_bb_bulleted_list_content ul li .bt_bb_bulleted_list_icon{
    color: {$accentColor};}
:root{
    --accent-color: {$accentColor};
    --alternate-color: {$alternateColor};}
", array() );