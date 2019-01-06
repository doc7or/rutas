// In this section we set up the content to be placed dynamically on the page.
// Customize movie tags and alternate html content below.

if (!useRedirect) {    // if dynamic embedding is turned on
  if(hasRightVersion) {  // if we've detected an acceptable version
   var oeTags = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"'
    + 'width="740" height="90" title="Di cosa hai bisogno?"'
    + 'codebase="https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">'
    + '<param name="movie" value="images/bottoni_HEADER.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><param name=wmode value=transparent><param name="SCALE" value="noborder" />'
    + '<embed src="images/bottoni_HEADER.swf" quality="high" bgcolor="#ccc" wmode=transparent scale="noborder"'
    + 'width="740" height="90" name="bottoni_HEADER" align="middle"'
    + 'play="true"'
    + 'loop="false"'
    + 'quality="high"'
    + 'allowScriptAccess="sameDomain"'
    + 'type="application/x-shockwave-flash"'
    + 'pluginspage="https://www.macromedia.com/go/getflashplayer">'
    + '<\/EMBED>'
    + '<\/OBJECT>';
    document.write(oeTags);   // embed the flash movie
  } else {  // flash is too old or we can't detect the plugin
    var alternateContent = '<a href="http://www.poste.it/esigenze/" target="_self"><img src="images/bottoni_HEADER_def.jpg" WIDTH="740" HEIGHT="90" alt="Di cosa hai bisogno?" BORDER=0></a>';
    document.write(alternateContent);  // insert non-flash content
  }
}