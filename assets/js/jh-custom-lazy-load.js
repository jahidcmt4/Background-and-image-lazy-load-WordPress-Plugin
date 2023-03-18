if (bgimglazy_data.bgimglazy_bg == "1") {
  jQuery('*').filter(function() {
  if (this.currentStyle)
    return this.currentStyle['backgroundImage'] !== 'none';
  else if (window.getComputedStyle)
    return document.defaultView.getComputedStyle(this,null)
  .getPropertyValue('background-image') !== 'none';
  }).addClass('bgimglazy-load');

  jQuery('.bgimglazy-load').each(function () {
    var jh_background_image = jQuery(this).css('backgroundImage');
    var jh_bacground_image_url = jh_background_image.replace('url(','').replace(')','');
    var jh_background_image_clean_path = jh_bacground_image_url.replace(/"/g, "");
    jQuery(this).attr("data-jh-lazy-img", jh_background_image_clean_path);
  });
}
jQuery('.bgimglazy-load').css('background-image', 'none');

if (bgimglazy_data.bgimglazy_images == "1") {
  jQuery("img").each(function() {
    var jh_current_img_src = this.src;        
    jQuery(this).attr("data-jh-lazy-img", jh_current_img_src);
    jQuery('img').addClass("bgimglazy-load");

  });
  jQuery("img").each(function() {
    var jh_image_preloader=bgimglazy_data.bgimglazy_icon;
    var jh_current_img_src = this.src;        
    var jh_old_src = jh_current_img_src;
    var jh_new_src = jh_image_preloader;
    jQuery('img[src="' + jh_old_src + '"]').attr('src', jh_new_src);
  });
}

jQuery('.bgimglazy-load').jhLoadImage({
  offset: '75%',
  delay: 750,
  pluginId: 'jhLoadImage'
});