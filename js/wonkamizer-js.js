( function( $ ) 
{
  var window_Yoffset = window.pageYOffset;
  var header = ( document.querySelector( 'header#masthead' ) ) ? document.querySelector( 'header#masthead' ): '';
  window.onload = function() 
  {

    if ( document.querySelector( '#wpadminbar' ) && document.querySelector( 'body.home' ) ) 
    {
      document.querySelector( 'header#masthead' ).style.top = document.querySelector( '#wpadminbar' ).offsetHeight + 'px';
    }

    if ( document.querySelector( '#site-navigation' ) ) 
    {
      if ( window_Yoffset > 0 ) 
      {
        fix_header();
      }
      window.onscroll = function()
      {
        fix_header();
      };
    }
  };


function fix_header() 
{
  window_Yoffset = window.pageYOffset;
  var children_nodes = header.childNodes;
  if ( window_Yoffset > 5 && window_Yoffset < document.body.scrollHeight && window.innerWidth > 767 ) 
  {
    if ( header.classList.contains( 'fixed-nav' ) === false ) 
    {
      header.classList.add( 'fixed-nav' );
      if ( document.querySelector( '#wpadminbar' ) ) 
        {
          document.querySelector( 'header#masthead' ).style.top = document.querySelector( '#wpadminbar' ).offsetHeight + 'px';
        }
    }
  }
  else
  {
    if ( header.classList.contains( 'fixed-nav' ) ) 
    {
      header.classList.remove( 'fixed-nav' );
      if ( document.querySelector( '#wpadminbar' ) && 'undefined' === document.querySelector( 'body.home' ) ) {
        document.querySelector( 'header#masthead' ).removeAttribute( 'style' );
      }
    }
  }
}

})(jQuery);