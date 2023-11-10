<style>

    @if(get_static_option('navbar_variant') == '01')
    /* navbar style 01 */
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01{
        background-color: {{get_static_option('navbar_background_color','transparent')}};
    }
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01 .nav-container .navbar-collapse .navbar-nav li a ,
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01 .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children:before,
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01 .nav-container .navbar-collapse .navbar-nav li.menu-item-has-mega-menu:before,
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01 .nav-container .nav-right-content ul li,
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01 .nav-container .nav-right-content ul li a
    {
        color:  {{get_static_option('navbar_text_color','rgba(255, 255, 255, .8)')}};
    }
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01 .nav-container .navbar-collapse .navbar-nav li a:hover ,
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01 .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children:hover:before,
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01 .nav-container .navbar-collapse .navbar-nav li.menu-item-has-mega-menu:hover:before,
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01 .nav-container .nav-right-content ul li:hover,
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01 .nav-container .nav-right-content ul li a:hover
    {
        color:  {{get_static_option('navbar_text_hover_color','var(--main-color-one)')}};
    }
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01 .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu li a {
        background-color: {{get_static_option('navbar_dropdown_background_color','#fff')}};
        color: {{get_static_option('navbar_dropdown_text_color','var(--paragraph-color)')}};
    }
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01 .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu li a:hover {
        background-color: {{get_static_option('navbar_dropdown_hover_background_color','var(--main-color-one)')}};
        color: {{get_static_option('navbar_dropdown_hover_text_color','#fff')}};
    }
    .header-style-01.navbar-variant-01 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu{
        border-bottom-color: {{get_static_option('navbar_dropdown_border_bottom_color','var(--main-color-one)')}};
    }
    .header-style-01.navbar-variant-01 .mobile-cart a .pcount,
    .header-style-01.navbar-variant-01 .navbar-area .nav-container .nav-right-content ul li.cart .pcount{
        background-color: {{get_static_option('navbar_cart_background_color','var(--main-color-one)')}};
        color: {{get_static_option('navbar_cart_text_color','#fff')}};
    }
    .navbar-variant-01 .navbar-area .nav-container .navbar-collapse .navbar-nav li.current-menu-item a {
        color: {{get_static_option('navbar_dropdown_hover_text_color','#fff')}}; !important;
    }
    .header-style-01.navbar-variant-01 .navbar-area.nav-style-01.nav-fixed{
        background-color: #333;
    }
    @endif
    /* navbar style 02 */
    @if(get_static_option('navbar_variant') == '02')
    .navbar-variant-02 .navbar-area,
    .navbar-variant-02 .navbar-area .nav-container{
        background-color: {{get_static_option('navbar_background_color','transparent')}};
    }
    .navbar-variant-02 .navbar-area .nav-container .navbar-collapse .navbar-nav li a ,
    .navbar-variant-02 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children:before,
    .navbar-variant-02 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-mega-menu:before,
    .navbar-variant-02 .navbar-area .nav-container .nav-right-content ul li,
    .navbar-variant-02 .navbar-area .nav-container .nav-right-content ul li a
    {
        color:  {{get_static_option('navbar_text_color','var(--paragraph-color)')}};
    }
    .navbar-variant-02 .navbar-area .nav-container .navbar-collapse .navbar-nav li a:hover ,
    .navbar-variant-02 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children:hover:before,
    .navbar-variant-02 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-mega-menu:hover:before,
    .navbar-variant-02 .navbar-area .nav-container .nav-right-content ul li:hover,
    .navbar-variant-02 .navbar-area .nav-container .nav-right-content ul li a:hover
    {
        color:  {{get_static_option('navbar_text_hover_color','var(--main-color-one)')}};
    }
    .navbar-variant-02 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu li a {
        background-color: {{get_static_option('navbar_dropdown_background_color','#fff')}};
        color: {{get_static_option('navbar_dropdown_text_color','var(--paragraph-color)')}};
    }
    .navbar-variant-02 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu li a:hover {
        background-color: {{get_static_option('navbar_dropdown_hover_background_color','var(--main-color-one)')}};
        color: {{get_static_option('navbar_dropdown_hover_text_color','#fff')}};
    }
    .navbar-variant-02 .navbar-area .nav-container .navbar-collapse .navbar-nav li.current-menu-item a {
        color: {{get_static_option('navbar_dropdown_hover_text_color','var(--main-color-one)')}}; !important;
    }
    .navbar-variant-02 .navbar-area .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu{
        border-bottom-color: {{get_static_option('navbar_dropdown_border_bottom_color','var(--main-color-one)')}};
    }
    .navbar-variant-02 .mobile-cart a .pcount,
    .navbar-variant-02 .navbar-area .nav-right-content ul li.cart .pcount{
        background-color: {{get_static_option('navbar_cart_background_color','var(--main-color-one)')}};
        color: {{get_static_option('navbar_cart_text_color','#fff')}};
    }
     .header-style-03.header-variant-06.navbar-variant-02 .logo-wrapper:after{
        background-color: {{get_static_option('navbar_cart_background_color','var(--logistic-color)')}};
    }

    @endif

    /* navbar style 03 */
    @if(get_static_option('navbar_variant') == '03')
    .navbar-variant-03 .header-style-03.header-variant-07 .nav-container,
    .navbar-variant-03 .header-style-03.header-variant-07 .navbar-area{
        background-color: {{get_static_option('navbar_background_color','#191d33')}};
    }
    .navbar-variant-03 .mobile-cart a .pcount,
    .navbar-variant-03 .navbar-area .nav-right-content ul li.cart .pcount{
        background-color: {{get_static_option('navbar_cart_background_color','var(--main-color-one)')}};
        color: {{get_static_option('navbar_cart_text_color','#fff')}};
    }


    .navbar-variant-03 .navbar-area .nav-container .navbar-collapse .navbar-nav li a ,
    .navbar-variant-03 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children:before,
    .navbar-variant-03 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-mega-menu:before,
    .navbar-variant-03 .navbar-area .nav-container .nav-right-content ul li,
    .navbar-variant-03 .navbar-area .nav-container .nav-right-content ul li a,
    .header-style-03.header-variant-07 .navbar-area .nav-container .nav-right-content ul li a
    {
        color:  {{get_static_option('navbar_text_color','rgba(255, 255, 255, .8)')}};
    }
    .navbar-variant-03 .navbar-area .nav-container .navbar-collapse .navbar-nav li a:hover ,
    .navbar-variant-03 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children:hover:before,
    .navbar-variant-03 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-mega-menu:hover:before,
    .navbar-variant-03 .navbar-area .nav-container .nav-right-content ul li:hover,
    .navbar-variant-03 .navbar-area .nav-container .nav-right-content ul li a:hover
    {
        color:  {{get_static_option('navbar_text_hover_color','var(--main-color-one)')}};
    }
    .navbar-variant-03 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu li a {
        background-color: {{get_static_option('navbar_dropdown_background_color','#fff')}};
        color: {{get_static_option('navbar_dropdown_text_color','var(--paragraph-color)')}};
    }
    .navbar-variant-03 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu li a:hover {
        background-color: {{get_static_option('navbar_dropdown_hover_background_color','var(--main-color-one)')}};
        color: {{get_static_option('navbar_dropdown_hover_text_color','#fff')}};
    }
    .navbar-variant-03 .navbar-area .nav-container .navbar-collapse .navbar-nav li.current-menu-item a {
        color: {{get_static_option('navbar_dropdown_hover_text_color','#fff')}}; !important;
    }
    .navbar-variant-03 .navbar-area .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu{
        border-bottom-color: {{get_static_option('navbar_dropdown_border_bottom_color','var(--main-color-one)')}};
    }
    .navbar-variant-03 .mobile-cart a .pcount,
    .navbar-variant-03 .navbar-area .nav-right-content ul li.cart .pcount{
        background-color: {{get_static_option('navbar_cart_background_color','var(--main-color-one)')}};
        color: {{get_static_option('navbar_cart_text_color','#fff')}};
    }
    .navbar-variant-03 .industry-support-wrap{
        background-color: {{get_static_option('topbar_background_color','#fff')}};
    }
    .navbar-variant-03 .industry-single-info-item .title{
        color: {{get_static_option('topbar_info_title_color','var(--heading-color)')}};
    }
    .navbar-variant-03 .industry-single-info-item .icon{
        color: {{get_static_option('topbar_info_icon_color','var(--industry-color)')}};
    }
    .navbar-variant-03 .industry-single-info-item .details,
    .navbar-variant-03 .industry-top-right-list li:last-child #langchange,
    .navbar-variant-03 .industry-top-right-list li a ,
    .navbar-variant-03 .industry-top-right-list li span{
        color: {{get_static_option('topbar_text_color','var(--paragraph-color)')}};
    }
    .navbar-variant-03 .industry-top-right-list li a:hover {
        color: {{get_static_option('topbar_text_hover_color','var(--main-color-one)')}};
    }

    @endif

    /* navbar style 04 */
    @if(get_static_option('navbar_variant') == '04')
    .header-style-03.navbar-variant-04 .navbar-area,
    .header-style-03.navbar-variant-04 .navbar-area .nav-container{
        background-color: {{get_static_option('navbar_background_color','transparent')}};
    }
    .header-style-03.navbar-variant-04 .navbar-area .nav-container .navbar-collapse .navbar-nav li a ,
    .header-style-03.navbar-variant-04 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children:before,
    .header-style-03.navbar-variant-04 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-mega-menu:before,
    .header-style-03.navbar-variant-04 .navbar-area .nav-container .nav-right-content ul li,
    .header-style-03.navbar-variant-04 .navbar-area .nav-container .nav-right-content ul li a
    {
        color:  {{get_static_option('navbar_text_color','var(--paragraph-color)')}};
    }
    .header-style-03.navbar-variant-04 .navbar-area .nav-container .navbar-collapse .navbar-nav li a:hover ,
    .header-style-03.navbar-variant-04 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children:hover:before,
    .header-style-03.navbar-variant-04 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-mega-menu:hover:before,
    .header-style-03.navbar-variant-04 .navbar-area .nav-container .nav-right-content ul li:hover,
    .header-style-03.navbar-variant-04 .navbar-area .nav-container .nav-right-content ul li a:hover
    {
        color:  {{get_static_option('navbar_text_hover_color','var(--main-color-one)')}};
    }
    .header-style-03.navbar-variant-04 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu li a {
        background-color: {{get_static_option('navbar_dropdown_background_color','#fff')}};
        color: {{get_static_option('navbar_dropdown_text_color','var(--paragraph-color)')}};
    }
    .header-style-03.navbar-variant-04 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu li a:hover {
        background-color: {{get_static_option('navbar_dropdown_hover_background_color','var(--main-color-one)')}};
        color: {{get_static_option('navbar_dropdown_hover_text_color','#fff')}};
    }
    .header-style-03.navbar-variant-04 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu{
        border-bottom-color: {{get_static_option('navbar_dropdown_border_bottom_color','var(--main-color-one)')}};
    }
    .header-style-03.navbar-variant-04 .mobile-cart a .pcount,
    .header-style-03.navbar-variant-04 .navbar-area .nav-container .nav-right-content ul li.cart .pcount{
        background-color: {{get_static_option('navbar_cart_background_color','var(--main-color-one)')}};
        color: {{get_static_option('navbar_cart_text_color','#fff')}};
    }
    .navbar-variant-04 .navbar-area .nav-container .navbar-collapse .navbar-nav li.current-menu-item a {
        color: {{get_static_option('navbar_dropdown_hover_text_color','var(--main-color-one)')}}; !important;
    }
    @endif
    /* navbar style 05 */
    @if(get_static_option('navbar_variant') == '05')
    .navbar-variant-05 .navbar-area,
    .navbar-variant-05 .navbar-area .nav-container{
        background-color: {{get_static_option('navbar_background_color','var(--secondary-color)')}};
    }
    .navbar-variant-05 .navbar-area .nav-container .navbar-collapse .navbar-nav li a ,
    .navbar-variant-05 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children:before,
    .navbar-variant-05 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-mega-menu:before,
    .navbar-variant-05 .navbar-area .nav-container .nav-right-content ul li,
    .navbar-variant-05 .navbar-area .nav-container .nav-right-content ul li a
    {
        color:  {{get_static_option('navbar_text_color','rgba(255, 255, 255, .8)')}};
    }
    .navbar-variant-05 .navbar-area .nav-container .navbar-collapse .navbar-nav li a:hover ,
    .navbar-variant-05 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children:hover:before,
    .navbar-variant-05 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-mega-menu:hover:before,
    .navbar-variant-05 .navbar-area .nav-container .nav-right-content ul li:hover,
    .navbar-variant-05 .navbar-area .nav-container .nav-right-content ul li a:hover
    {
        color:  {{get_static_option('navbar_text_hover_color','var(--main-color-one)')}};
    }
    .navbar-variant-05 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu li a {
        background-color: {{get_static_option('navbar_dropdown_background_color','#fff')}};
        color: {{get_static_option('navbar_dropdown_text_color','var(--paragraph-color)')}};
    }
    .navbar-variant-05 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu li a:hover {
        background-color: {{get_static_option('navbar_dropdown_hover_background_color','var(--main-color-one)')}};
        color: {{get_static_option('navbar_dropdown_hover_text_color','#fff')}};
    }
    .navbar-variant-05 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu{
        border-bottom-color: {{get_static_option('navbar_dropdown_border_bottom_color','var(--main-color-one)')}};
    }
    .navbar-variant-05 .mobile-cart a .pcount,
    .navbar-variant-05 .navbar-area .nav-container .nav-right-content ul li.cart .pcount{
        background-color: {{get_static_option('navbar_cart_background_color','var(--main-color-one)')}};
        color: {{get_static_option('navbar_cart_text_color','#fff')}};
    }
    .navbar-variant-05 .navbar-area .nav-container .navbar-collapse .navbar-nav li.current-menu-item a {
        color: {{get_static_option('navbar_dropdown_hover_text_color','#fff')}}; !important;
    }


    .navbar-variant-05 .construction-support-area{
        background-color: {{get_static_option('topbar_background_color','#fff')}};
    }
    .navbar-variant-05 .construction-single-info-list-item .content .subtitle{
        color: {{get_static_option('topbar_info_title_color','var(--heading-color)')}};
    }
    .navbar-variant-05 .construction-single-info-list-item .icon{
        color: {{get_static_option('topbar_info_icon_color','var(--industry-color)')}};
    }
    .navbar-variant-05 .construction-single-info-list-item .content .title,
    .navbar-variant-05 .construction-support-area .support-inner .right-content-wrap ul #langchange,
    .navbar-variant-05 .right-content-wrap li a ,
    .navbar-variant-05 .right-content-wrap li span{
        color: {{get_static_option('topbar_text_color','var(--heading-color)')}};
    }
    .navbar-variant-05 .right-content-wrap li a:hover {
        color: {{get_static_option('topbar_text_hover_color','var(--heading-color)')}};
    }
     .navbar-variant-05 .construction-support-area .support-inner .boxed-btn {
        background-color: {{get_static_option('topbar_button_background_color','var(--main-color-two)')}};
        color: {{get_static_option('topbar_button_text_color','#fff')}}
    }
     .navbar-variant-05 .construction-support-area .support-inner .boxed-btn:hover {
        background-color: {{get_static_option('topbar_button_background_hover_color','var(--main-color-one)')}};
        color: {{get_static_option('topbar_button_text_hover_color','#fff')}};
    }

    @endif

    /* navbar style 06 */
    @if(get_static_option('navbar_variant') == '06')
    .navbar-variant-06 .navbar-area .nav-container{
        background-color: {{get_static_option('navbar_background_color','#fff')}};
    }
    .navbar-variant-06 .navbar-area .nav-container .navbar-collapse .navbar-nav li a ,
    .navbar-variant-06 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children:before,
    .navbar-variant-06 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-mega-menu:before,
    .navbar-variant-06 .navbar-area .nav-container .nav-right-content ul li,
    .navbar-variant-06 .navbar-area .nav-container .nav-right-content ul li a
    {
        color:  {{get_static_option('navbar_text_color','var(--paragraph-color)')}};
    }
    .navbar-variant-06 .navbar-area .nav-container .navbar-collapse .navbar-nav li a:hover ,
    .navbar-variant-06 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children:hover:before,
    .navbar-variant-06 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-mega-menu:hover:before,
    .navbar-variant-06 .navbar-area .nav-container .nav-right-content ul li:hover,
    .navbar-variant-06 .navbar-area .nav-container .nav-right-content ul li a:hover
    {
        color:  {{get_static_option('navbar_text_hover_color','var(--main-color-one)')}};
    }
    .navbar-variant-06 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu li a {
        background-color: {{get_static_option('navbar_dropdown_background_color','#fff')}};
        color: {{get_static_option('navbar_dropdown_text_color','var(--paragraph-color)')}};
    }
    .navbar-variant-06 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu li a:hover {
        background-color: {{get_static_option('navbar_dropdown_hover_background_color','var(--main-color-one)')}};
        color: {{get_static_option('navbar_dropdown_hover_text_color','#fff')}};
    }
    .navbar-variant-06 .navbar-area .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu{
        border-bottom-color: {{get_static_option('navbar_dropdown_border_bottom_color','var(--main-color-one)')}};
    }
    .navbar-variant-06 .mobile-cart a .pcount,
    .navbar-variant-06 .navbar-area .nav-container .nav-right-content ul li.cart .pcount{
        background-color: {{get_static_option('navbar_cart_background_color','var(--main-color-one)')}};
        color: {{get_static_option('navbar_cart_text_color','#fff')}};
    }
    .navbar-variant-06 .navbar-area .nav-container .navbar-collapse .navbar-nav li.current-menu-item a {
        color: {{get_static_option('navbar_dropdown_hover_text_color','var(--main-color-one)')}}; !important;
    }
    @endif
    /* topbar style */
    .top-bar-area {
        background-color: {{get_static_option('topbar_background_color','var(--secondary-color)')}};
    }
    .top-bar-inner ul li a,
    #langchange{
        color: {{get_static_option('topbar_text_color','#f2f2f2')}};
    }
    .top-bar-inner ul li a:hover {
        color: {{get_static_option('topbar_text_hover_color','var(--main-color-two)')}};
    }
    .top-bar-inner .btn-wrapper .boxed-btn.reverse-color {
        background-color: {{get_static_option('topbar_button_background_color','var(--main-color-two)')}};
        color: {{get_static_option('topbar_button_text_color','#fff')}}
    }
    .top-bar-inner .btn-wrapper .boxed-btn.reverse-color:hover {
        background-color: {{get_static_option('topbar_button_background_hover_color','var(--main-color-two)')}};
        color: {{get_static_option('topbar_button_text_hover_color','#fff')}};
    }


    /* mega style */
    .xg_mega_menu_wrapper{
        background-color: {{get_static_option('mega_menu_background_color','#fff')}};;
    }

    .xg-mega-menu-single-column-wrap .mega-menu-title{
        color: {{get_static_option('mega_menu_title_color','var(--heading-color)')}};
    }
    .xg-mega-menu-single-column-wrap ul li a,
    .xg-mega-menu-single-column-wrap ul .single-mega-menu-product-item .title,
    .xg-mega-menu-single-column-wrap ul .single-mega-menu-product-item .content .price-wrap .price,
    .single-donation-mega-menu-item .title{
        color: {{get_static_option('mega_menu_text_color','var(--paragraph-color)')}} !important;
    }
    .single-donation-mega-menu-item .content .goal h4{
        color: {{get_static_option('mega_menu_text_color','var(--paragraph-color)')}} !important;
        opacity: .6;
    }
    .xg-mega-menu-single-column-wrap ul li a:hover,
    .xg-mega-menu-single-column-wrap ul .single-mega-menu-product-item .title:hover,
    .single-donation-mega-menu-item .title:hover{
        color: {{get_static_option('mega_menu_text_hover_color','var(--main-color-color)')}} !important;
    }
    .xg-mega-menu-single-column-wrap ul .single-mega-menu-product-item .content .price-wrap del{
        color: {{get_static_option('mega_menu_text_color','var(--paragraph-color)')}} !important;
        opacity: .6;
    }
    .single-donation-mega-menu-item .content .boxed-btn{
        background-color: {{get_static_option('mega_menu_button_background_color','var(--main-color-one)')}};
        color: {{get_static_option('mega_menu_button_text_color','#fff')}} !important;
    }
    .single-donation-mega-menu-item .content .boxed-btn:hover{
        background-color: {{get_static_option('mega_menu_button_background_hover_color','var(--main-color-one)')}} ;
        color: {{get_static_option('mega_menu_button_text_hover_color','#fff')}} !important;
    }
    /* breadcrumb css */
    .breadcrumb-area .breadcrumb-inner{
        padding-top: {{get_static_option('breadcrumb_padding_top',215)}}px;
        padding-bottom: {{get_static_option('breadcrumb_padding_bottom',142)}}px;
    }
    .breadcrumb-area:before{
        background-color: {{get_static_option('breadcrumb_background_overlay_color','rgba(0, 0, 0, .6)')}} ;
    }
    .breadcrumb-area .page-title{
        color: {{get_static_option('breadcrumb_title_color','#fff')}};
    }
    .breadcrumb-area .page-list li:first-child a{
        color: {{get_static_option('breadcrumb_text_active_color','var(--main-color-one)')}};
    }
    .breadcrumb-area .page-list li{
        color: {{get_static_option('breadcrumb_text_color','rgba(255, 255, 255, .7)')}};
    }

    /* footer css */
    .footer-area .copyright-area{
        background-color:{{get_static_option('footer_copyright_area_background_color','#2d316a')}} !important;
        color: {{get_static_option('footer_copyright_area_text_color','rgba(255, 255, 255, .7)')}};
    }
    .footer-area .footer-top {
        background-color: {{get_static_option('footer_background_color','#202353')}} !important;
    }
    .widget.footer-widget .widget-title {
        color: {{get_static_option('footer_widget_title_color','rgba(255, 255, 255, .9)')}};
    }
    .contact_info_list li.single-info-item .icon,
    .footer-widget.widget_nav_menu ul li a:after
    {
        color: {{get_static_option('footer_widget_icon_color','var(--main-color-two)')}};
    }
    .footer-area .footer-widget.widget_tag_cloud .tagcloud a,
    .footer-area .widget.footer-widget p,
    .footer-area .widget.footer-widget.widget_calendar caption,
    .footer-area .widget.footer-widget.widget_calendar td,
    .footer-area .widget.footer-widget.widget_calendar th,
    .footer-area .widget.footer-widget ul li,
    .footer-area .widget.footer-widget ul li a {
        color: {{get_static_option('footer_widget_text_color','rgba(255, 255, 255, .6)')}};
    }

    .footer-area .footer-widget.widget_tag_cloud .tagcloud a:hover,
    .footer-area .widget.footer-widget ul li a:hover {
        color: {{get_static_option('footer_widget_text_hover_color','rgba(255, 255, 255, .6)')}};
    }

</style>