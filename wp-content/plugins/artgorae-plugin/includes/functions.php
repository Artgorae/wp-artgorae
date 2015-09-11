<?php

/**
 * Save the default product data meta.
 */

add_action( 'dokan_new_product_added', 'new_process_product_meta', 10, 2 );

function new_process_product_meta( $product_id )
{
	update_post_meta( $product_id, '_visibility', 'visible' );

	wp_update_post( array(
		'ID'             => $product_id,
		'comment_status' => 'open'
	) );
}


/**
 * Follow button
 */

function get_follow_button()
{
	if ( bp_follow_is_following( array( 'leader_id' => get_the_author_meta( 'ID' ), 'follower_id' => bp_loggedin_user_id() ) ) ) {
		$link_text = __( 'Unfollow', 'artgorae' );
	} else {
		$link_text = __( 'Follow', 'artgorae' );
	}

	$args = array(
		'leader_id' => get_the_author_meta( 'ID' ),
		'follower_id' => bp_loggedin_user_id(),
		'link_text' => $link_text,
		'link_class' => 'button alt',
		'wrapper' => ''
	);
	echo bp_follow_get_add_follow_button( $args );
}

add_filter( 'bp_follow_get_add_follow_button', 'bp_follow_get_add_follow_button_add_icon', 10, 3);
function bp_follow_get_add_follow_button_add_icon( $button, $leader_id, $follower_id ) {
	if ( explode( ' ', $button['link_class'] )[0] == 'follow' ) {
		$link_icon = '<i class="fa fa-star"></i> ';
	} else {
		$link_icon = '<i class="fa fa-star-o"></i> ';
	}
	$button['link_text'] = $link_icon . $button['link_text'];
	return $button;
}


/**
 * Add contact info to purchase note
 */

add_action( 'dokan_new_product_added', 'add_contact_info_to_purchase_note', 10, 2 );

function add_contact_info_to_purchase_note( $product_id )
{
	$post_author_id = get_post_field( 'post_author', $product_id );

	$contact_name = get_the_author_meta( 'user_lastname', $post_author_id ) . get_the_author_meta( 'user_firstname', $post_author_id );
	$contact_email = get_the_author_meta( 'user_email', $post_author_id );
	$contact_info = sprintf( __( "<b>Seller Information</b>\nName: %s\nEmail: %s", 'artgorae' ), $contact_name, $contact_email );

	update_post_meta( $product_id, '_purchase_note', $contact_info );
}


/**
 * Create custom order button
 */

function create_custom_order( $title, $content, $price )
{
	$title = empty( $title ) ? __( 'Custom-order product', 'artgorae' ) : $title;
	$content = empty( $content ) ? __( 'This is a custom-order product.', 'artgorae' ) : $content;

    $post = array(
    	'post_content'  => $content,
        'post_title'    => $title,
        'post_status'	=> 'publish',
        'comment_status'=> 'close',
        'post_type'		=> 'product'
    );
    $post_id = wp_insert_post( $post );
    $custom_term = get_term_by( 'slug', 'custom-order', 'product_cat' );
    wp_set_object_terms( $post_id, $custom_term->term_id, 'product_cat' );
    update_post_meta( $post_id, '_visibility', 'hidden' );
    update_post_meta( $post_id, '_price', $price );
    return $post_id;
}

function get_custom_order_button( $title, $content, $price )
{
    $post_id = create_custom_order( $title, $content, $price );

    $button_link = esc_url( get_permalink( $post_id ) );
    $button_class = 'button alt';
    $button_text = __( 'View Product', 'artgorae' );

    $button_html = sprintf( '<a href="%s" class="%s">%s</a>', $button_link, $button_class, $button_text );
    return $button_html;
}


/**
 * Contact to seller button
 */

add_action( 'tokopress_wc_product_calltoaction', 'add_contact_seller_button', 70 );

function add_contact_seller_button()
{
	$author_username = get_the_author_meta('user_login');
	echo contact_seller_button( $author_username );
	?>
	<style>
	.single_contact_seller_button {
		text-align: center;
		width: 100%;
	}
	</style>
	<?php
}

function contact_seller_button( $author_username ) {
	$button_text = __( 'Ask to Seller', 'artgorae' );
	$subject = __( 'You have new message!', 'artgorae' );
	$button_class = 'single_contact_seller_button single_add_to_cart_button button alt';
	$message_link = do_shortcode("[pm_user user_name=$author_username text='$button_text' class='$button_class' subject='$subject' in_the_loop=true]");

	return $message_link;
}

function search_shortcode()
{
	?>
		<ul id="mode-tab" class="nav nav-tabs nav-justified">
		<li class="active"><a>예술재능</a></li>
		<li><a>예술작품</a></li>
		</ul>
		<div id="search">
		<div id="tag-cloud-container">
		<h3>예술 스타일</h3>
		<h3>예술 장르</h3>
		<div id="meta-refresh-button"><i class="fa fa-refresh"><span class="trp">r</span></i></div>
		<div id="tag-cloud-aligner">
		<div id="tag-cloud-meta">
		<div class="cloud-item tag-cloud-meta-item">스타일</div>
		<div class="cloud-item tag-cloud-meta-item">스타일</div>
		<div class="cloud-item tag-cloud-meta-item">스타일</div>
		<div class="cloud-item tag-cloud-meta-item">스타일</div>
		<div class="cloud-item tag-cloud-meta-item">스타일</div>
		<div class="cloud-item tag-cloud-meta-item">스타일</div>
		<div class="cloud-item tag-cloud-meta-item">스타일</div>
		<div class="cloud-item tag-cloud-meta-item">스타일</div>
		<div class="cloud-item tag-cloud-meta-item">스타일</div>
		<div class="cloud-item tag-cloud-meta-item">스타일</div>
		</div>
		<div id="tag-cloud-category">
		<div class="cloud-item tag-cloud-category-item">카테고리</div>
		<div class="cloud-item tag-cloud-category-item">카테고리</div>
		<div class="cloud-item tag-cloud-category-item">카테고리</div>
		<div class="cloud-item tag-cloud-category-item">카테고리</div>
		<div class="cloud-item tag-cloud-category-item">카테고리</div>
		<div class="cloud-item tag-cloud-category-item">카테고리</div>
		<div class="cloud-item tag-cloud-category-item">카테고리</div>
		<div class="cloud-item tag-cloud-category-item">카테고리</div>
		<div class="cloud-item tag-cloud-category-item">카테고리</div>
		</div>
		</div>
		</div>
		</div>

<script>

var imgPrefix = 'http://wp-artgorae.s3.amazonaws.com/wp-content/uploads/';
var images = ['2015/09/02165657/tumblr_nr5qcp9YQx1slhhf0o1_1280.jpg', '2015/09/02165649/photo-1438109491414-7198515b166b.jpg', '2015/09/02165636/photo-1437915015400-137312b61975.jpg', '2015/09/02165624/photo-1437532437759-a0ce0535dfed.jpg', '2015/09/02165604/photo-1436891620584-47fd0e565afb.jpg', '2015/09/02165550/photo-1431578500526-4d9613015464.jpg', '2015/09/02165536/photo-1429734160945-4f85244d6a5a.jpg', '2015/09/02165524/photo-1428856472086-8674d9cbd6bc.jpg', '2015/09/02165517/photo-1424746219973-8fe3bd07d8e3.jpg', '2015/09/02165507/aa322c2d.jpg', '2015/09/02165453/226H.jpg', '2015/09/02165436/197H.jpg', '2015/09/02165421/168H.jpg', '2015/09/02165407/105H.jpg', '2015/09/02165353/83H.jpg'];

var metaPosition = [[45,130], [55,280], [60,400], [140,80], [140,200], [170,330], [165,470], [245,120], [265,250], [270,410]];
var metaDim = [85, 85, 100, 75, 110, 120, 110, 120, 100, 100];

var talentPosition = [[50,80],[50,180],[45,290],[40,390],[160,70],[170,190],[150,305],[140,400],[80,490],[260,110],[255,285],[250,400],[200,500]];
var talentDim = [75, 100, 100, 80, 100, 120, 90, 90, 110, 90, 100, 100, 90, 40, 40, 40, 40];

var workPosition = [[60,90],[50,240],[50,420],[160,170],[160,330],[150,480],[250,100],[260,240],[250,430],[300,300]];
var workDim = [110, 100, 100, 110, 140, 100, 100, 100, 100];

var tags = ['감상적인', '강한', '거시기한', '거친', '고급스러운', '깔끔한', '남성스러운', '도시적인', '러블리한', '멋있는', '모노톤', '모던한', '밝은', '부드러운', '빠른', '세련된', '심플한', '아기자기한', '아름다운', '어두운'];
var workCategories = ['공예품', '잡동사니 ', 'Fine Art', '폰케이스', '에코백', '아트토이', '액세서리', '포스터', '전통공예'];
var talentCategories = ['UI/UX', '그래픽아트', 'CI/BI', '포토그래피', '캘리그라피', '영상/모션그래픽', '일러스트', '아트토이', '인포그래픽', '편집디자인', 'Fine Art', '3D 그래픽', '공예'];

var category_switch = true;

var tag_positions = [];

var search_terms = [];
$('.search-bg').css('background-image', 'url(' + imgPrefix+images[parseInt(Math.random()*images.length)] + ')');

jQuery(document).ready(function(){
    $('#mode-tab li').click(function(){
        if(!$(this).hasClass('active')){
            $('#mode-tab li').each(function(){
                $(this).removeClass('active');
            });
            $(this).addClass('active');
            category_switch = !category_switch;

            mixCategoryTags();
        }
    });
    
    mixMetaTags();
    mixCategoryTags();
    
    $("#meta-refresh-button").click(function(){
        mixMetaTags();
    });

    $('.tag-cloud-meta-item').click(function(){
        $(this).toggleClass('active');
        if($(this).hasClass('active')){
            search_terms.push($(this).html());
        }
        else{
            var index = search_terms.indexOf($(this).html());
            search_terms.splice(index, 1);
        }
        refreshSearchBar();
    });
    
});

function mixMetaTags(){
    tag_positions = [];
    iw = $('#tag-cloud-meta').innerWidth();
    ih = $('#tag-cloud-meta').innerHeight();
    
    var tag_index = parseInt(Math.random()*tags.length);
    
    $('.tag-cloud-meta-item').each(function(index){
        var posX = metaPosition[index][1]*(iw/526.5);
        var posY = metaPosition[index][0]*(iw/526.5);
        var size = metaDim[index]*(iw/526.5);
        
        /*
        do{
            posX = Math.random()*iw;
            posY = Math.random()*ih;
            size = Math.random()*50+iw/7;
        }
        while(!(posY-size/2>0 && posY+size/2<ih && posX-size/2>0 && posX+size/2<iw) || checkOverlap(posX, posY, size))
        tag_positions.push([posX, posY, size]);
        */
        
        $(this).html(tags[tag_index]);
        var txt_size = size*0.7/$(this).html().length;
        txt_size = Math.min(txt_size, 24);
        $(this).css('top', posY-size/2+'px');
        $(this).css('right', posX-size/2+'px');
        $(this).css('width', size+'px');
        $(this).css('height', size+'px');
        $(this).css('line-height', size+'px');
        $(this).css('font-size', txt_size+'px');
        
        $(this).removeClass('active');
        if(search_terms.indexOf($(this).html()) > -1){
           $(this).addClass('active');
        }
        
        tag_index = (tag_index+1)%tags.length;
    });
}

function mixCategoryTags(){
    iw = $('#tag-cloud-meta').innerWidth();
    ih = $('#tag-cloud-meta').innerHeight();

    $('#tag-cloud-category').empty();
    for(var i = 0; i<(category_switch?talentCategories.length:workCategories.length); i++){
        $('#tag-cloud-category').append('<div class="cloud-item tag-cloud-category-item"></div>');
    }

    $('.tag-cloud-category-item').click(function(){
        $(this).toggleClass('active');
        if($(this).hasClass('active')){
            search_terms.push($(this).html());
        }
        else{
            var index = search_terms.indexOf($(this).html());
            search_terms.splice(index, 1);
        }
        refreshSearchBar();
    });
    
    var tag_index = parseInt(Math.random()*(category_switch?talentCategories.length:workCategories.length));

    
    $('.tag-cloud-category-item').each(function(index){
        
        if(category_switch){
            var posX = talentPosition[index][1]*(iw/526.5);
            var posY = talentPosition[index][0]*(iw/526.5);
            var size = talentDim[index]*(iw/526);
        }
        else{
            var posX = workPosition[index][1]*(iw/526.5);
            var posY = workPosition[index][0]*(iw/526.5);
            var size = workDim[index]*(iw/526);
        }
            
        /*
        do{
            posX = Math.random()*iw;
            posY = Math.random()*ih;
            size = Math.random()*50+iw/7;
        }
        while(!(posY-size/2>0 && posY+size/2<ih && posX-size/2>0 && posX+size/2<iw) || checkOverlap(-posX, posY, size))
        
        tag_positions.push([-posX, posY, size]);
            */
        $(this).html(category_switch?talentCategories[tag_index]:workCategories[tag_index]);
        var txt_size = size*0.7/$(this).html().length;
        txt_size = Math.min(txt_size, 24);
        $(this).css('top', posY-size/2+'px');
        $(this).css('left', posX-size/2+'px');
        $(this).css('width', size+'px');
        $(this).css('height', size+'px');
        $(this).css('line-height', size+'px');
        $(this).css('font-size', txt_size+'px');
        
        $(this).removeClass('active');
        if(search_terms.indexOf($(this).html()) > -1){
           $(this).addClass('active');
        }
        
        tag_index = (tag_index+1)%(category_switch?talentCategories.length:workCategories.length);
    });
    
    
}


function checkOverlap(posX, posY, size){
    for(var i = 0; i<tag_positions.length; i++){
        if(dist(tag_positions[i][0], tag_positions[i][1], posX, posY)<tag_positions[i][2]/2+size/2+10)
            return true;
    }
    return false;
}

function dist(x1, y1, x2, y2){
    return Math.sqrt( (x1-x2)*(x1-x2) + (y1-y2)*(y1-y2) );
}

function resizedw(){
    mixMetaTags();
    mixCategoryTags();
}

var doit;
var last_x = $(window).width();
window.onresize = function(){
  if(last_x == $(window).width())
    return;
  last_x = $(window).width();
  clearTimeout(doit);
  doit = setTimeout(resizedw, 400);
};

function refreshSearchBar() {
    $('#custom-searchform input').val(search_terms);
    var searchKeyword = search_terms.toString().replace(/,/g, ' ');
    var searchBar = document.querySelector('.ajaxsearchpro');
    //$('input', searchBar).val('');
    $('input.orig', searchBar).val(searchKeyword).keydown();
    $('div.promagnifier', searchBar).click();
}

</script>


		
	<?php
}

add_shortcode( 'artgorae_search', 'search_shortcode' );