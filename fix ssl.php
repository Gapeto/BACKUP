add_filter("set_url_scheme", "rsssl_check_protocol_multisite", 20, 3 );

function rsssl_check_protocol_multisite($url, $scheme, $orig_scheme){
    if (is_multisite()) {
    //get blog id by url.
    //make sure the domain is with http, e.g. http://domain.com
    $domain = str_replace("https://","http://",$url);
    //remove http:// from the domain. e.g. domain.com
    $domain = str_replace("http://","",$domain);
    $blog_id = get_blog_id_from_url($domain);
    // exit if no blog id was found.
    if ($blog_id==0) return $url; //no blog id found
    
    //request the blog url and return it. If it is http, the returned url will now also be http.
    $url = get_blog_option($blog_id, "siteurl");
  }
  return $url;
}
