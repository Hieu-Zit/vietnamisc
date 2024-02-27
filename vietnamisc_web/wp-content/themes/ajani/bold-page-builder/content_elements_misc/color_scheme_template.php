<?php

$custom_css = "

	/* Portfolio / Post slider read more icon and text
	--------------------------------------- */
	.bt_bb_post_slider .bt_bb_grid_item_read_more.bt_bb_read_more_icon_color_scheme_{$scheme_id} a,
	.bt_bb_portfolio_slider .bt_bb_grid_item_read_more.bt_bb_read_more_icon_color_scheme_{$scheme_id} a {
		color: {$color_scheme[2]};
	}
	.bt_bb_post_slider .bt_bb_grid_item_read_more.bt_bb_read_more_icon_color_scheme_{$scheme_id} a .bt_bb_grid_item_icon,
	.bt_bb_portfolio_slider .bt_bb_grid_item_read_more.bt_bb_read_more_icon_color_scheme_{$scheme_id} a .bt_bb_grid_item_icon {
		background: {$color_scheme[2]};
		color: {$color_scheme[1]};
	}
	

	/* Price List
	--------------------------------------- */
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_price_list {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_price_list .bt_bb_price_list_title,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_price_list .bt_bb_price_list_price {
		color: {$color_scheme[2]};
	}


	/* Google map
	--------------------------------------- */
	.bt_bb_color_scheme_{$scheme_id} .bt_bb_google_maps.bt_bb_google_maps_with_content .bt_bb_google_maps_content .bt_bb_google_maps_content_wrapper .bt_bb_google_maps_location {
		background-color: {$color_scheme[2]};
		color: {$color_scheme[1]};
	}


	/* Progress bar
	--------------------------------------- */
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner {
		color: currentColor;
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_progress_bar.bt_bb_style_line.bt_bb_shape_rounded .bt_bb_progress_bar_inner:after {
		background-color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id} .bt_bb_progress_bar.bt_bb_style_line .bt_bb_progress_bar_inner {
		color: inherit !important;
	}
	

	/* Icons
	--------------------------------------- */
	/* Outline */
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_outline .bt_bb_icon_holder:before,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_outline:hover span.bt_bb_icon_holder:before {
		background-color: transparent;
		box-shadow: 0 0 0 2px {$color_scheme[1]} inset;
		color: {$color_scheme[1]};
	}	
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_outline:hover a.bt_bb_icon_holder:before {
		background-color: transparent;
		box-shadow: 0 0 0 2px {$color_scheme[1]} inset, 0 5px 20px rgba(0,0,0,.2);
		color: {$color_scheme[1]};
	}

	/* Filled */
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_filled .bt_bb_icon_holder:before,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_filled:hover span.bt_bb_icon_holder:before {
		box-shadow: none;
		color: {$color_scheme[1]};
		background-color: {$color_scheme[2]};
	}	
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_filled:hover a.bt_bb_icon_holder:before {
		color: {$color_scheme[1]};
		background-color: {$color_scheme[2]};
		box-shadow: 0 5px 20px rgba(0,0,0,.2);
		filter: brightness(1.1);
	}
	
	/* Borderless */
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_borderless .bt_bb_icon_holder:before,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_borderless:hover span.bt_bb_icon_holder:before {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_borderless:hover a.bt_bb_icon_holder:before,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_borderless:hover a:hover {
		color: {$color_scheme[2]};
	}
	
	/* Filled with light background */
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_filled_with_light_background .bt_bb_icon_holder:before,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_filled_with_light_background:hover span.bt_bb_icon_holder:before,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_filled_with_light_background .bt_bb_icon_holder:after,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_filled_with_light_background:hover span.bt_bb_icon_holder:after {
		color:  {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_icon.bt_bb_style_filled_with_light_background:hover a.bt_bb_icon_holder:after {
		background: {$color_scheme[1]};
	}

	.bt_bb_text_color_scheme_{$scheme_id}.bt_bb_icon a > span,
	.bt_bb_text_color_scheme_{$scheme_id}.bt_bb_icon span > span {
		color:  {$color_scheme[1]};
	}
	.bt_bb_text_color_scheme_{$scheme_id}.bt_bb_icon:hover a > span {
		color:  {$color_scheme[2]};
	}


	
	/* Services
	--------------------------------------- */
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_outline.bt_bb_service > .bt_bb_icon_holder,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_outline.bt_bb_service:hover > .bt_bb_icon_holder {
		background-color: transparent;
		box-shadow: 0 0 0 2px {$color_scheme[1]} inset;
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_outline.bt_bb_service:hover > a.bt_bb_icon_holder:hover {
		background-color: transparent;
		box-shadow: 0 0 0 2px {$color_scheme[1]} inset, 0 5px 20px rgba(0,0,0,.2);
		color: {$color_scheme[1]} !important;
	}	
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_filled.bt_bb_service > .bt_bb_icon_holder,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_filled.bt_bb_service:hover > .bt_bb_icon_holder {
		box-shadow: none;
		color: {$color_scheme[1]};
		background-color: {$color_scheme[2]};
	}	
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_filled.bt_bb_service:hover > a.bt_bb_icon_holder:hover	{
		color: {$color_scheme[1]};
		background-color: {$color_scheme[2]};
		box-shadow: 0 5px 20px rgba(0,0,0,.2);
		filter: brightness(1.1);
	}	
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_borderless.bt_bb_service > .bt_bb_icon_holder,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_borderless.bt_bb_service:hover > .bt_bb_icon_holder {
		color: {$color_scheme[1]};
	}	
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_borderless.bt_bb_service:hover > a.bt_bb_icon_holder:hover {
		color: {$color_scheme[2]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_filled_with_light_background.bt_bb_service > .bt_bb_icon_holder,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_filled_with_light_background.bt_bb_service:hover > .bt_bb_icon_holder {
		color:  {$color_scheme[1]};
	}	
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_style_filled_with_light_background.bt_bb_service:hover > a.bt_bb_icon_holder:hover:after	{
		background: {$color_scheme[1]};
	}
	.bt_bb_service .bt_bb_grid_item_read_more.bt_bb_read_more_icon_color_scheme_{$scheme_id} a {
		color: {$color_scheme[2]};
	}
	.bt_bb_service .bt_bb_grid_item_read_more.bt_bb_read_more_icon_color_scheme_{$scheme_id} a .bt_bb_grid_item_icon {
		background: {$color_scheme[2]};
		color: {$color_scheme[1]};
	}

	/* Buttons
	--------------------------------------- */
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_outline {
		border: 0;
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_outline a.bt_bb_link {
		box-shadow: 0 0 0 2px {$color_scheme[1]} inset;
		background-color: transparent;
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_outline a.bt_bb_link .bt_bb_button_text,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_outline a.bt_bb_link .bt_bb_icon_holder {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_outline:hover a.bt_bb_link,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_outline a.bt_bb_link:hover {
		box-shadow: 0 0 0 2px {$color_scheme[1]} inset, 0 5px 20px rgba(0,0,0,.2);
		background-color: transparent;
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_outline:hover a .bt_bb_button_text,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_outline a:hover .bt_bb_button_text {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_outline:hover a .bt_bb_icon_holder,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_outline a:hover .bt_bb_icon_holder {
		color: {$color_scheme[1]};
	}
	
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_filled {
		border: 0;
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_filled a,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_filled:hover a,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_filled a:hover {
		color: {$color_scheme[1]};
		background: {$color_scheme[2]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_filled a .bt_bb_button_text,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_filled a .bt_bb_icon_holder {
		color: {$color_scheme[1]};
	}
	.bt_bb_icon_color_scheme_{$scheme_id}.bt_bb_button a.bt_bb_link .bt_bb_icon_holder {
		background: {$color_scheme[2]};		
	}
	.bt_bb_icon_color_scheme_{$scheme_id}.bt_bb_button a.bt_bb_link .bt_bb_icon_holder:before {
		color: {$color_scheme[1]};
	}

	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_clean a {
		color: {$color_scheme[1]} !important;
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_button.bt_bb_style_clean a:hover {
		color: {$color_scheme[2]} !important;
	}


	/* Section
	--------------------------------------- */
	.bt_bb_section.bt_bb_color_scheme_{$scheme_id} {
		color: {$color_scheme[1]};
		background-color: {$color_scheme[2]};
	}
	
	/* Tabs
	--------------------------------------- */
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_tabs.bt_bb_style_simple .bt_bb_tabs_header li {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_tabs.bt_bb_style_simple .bt_bb_tabs_header li span:after {
		background: {$color_scheme[2]};
	}

	/* Simple accordion
	--------------------------------------- */
	.bt_bb_color_scheme_{$scheme_id} .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item .bt_bb_accordion_item_title:after {
		background-color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id} .bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_accordion.bt_bb_style_simple .bt_bb_accordion_item.on .bt_bb_accordion_item_title:after {
		background-color: {$color_scheme[2]};
	}	

	/* Process
	--------------------------------------- */
	.bt_bb_process.bt_bb_icon_color_scheme_{$scheme_id} .bt_bb_process_step .bt_bb_process_step_icon .bt_bb_icon_holder {
		background-color: {$color_scheme[2]};
		color: {$color_scheme[1]};
	}

	/* Icon bulleted list
	--------------------------------------- */
	.bt_bb_bulleted_list.bt_bb_icon_color_scheme_{$scheme_id} .bt_bb_icon_holder {
		color: {$color_scheme[1]};
	}
	
	/* Card 
	--------------------------------------- */
	.bt_bb_card .bt_bb_card_read_more.bt_bb_read_more_icon_color_scheme_{$scheme_id} a {
		color: {$color_scheme[2]};
	}
	.bt_bb_card .bt_bb_card_read_more.bt_bb_read_more_icon_color_scheme_{$scheme_id} a .bt_bb_grid_item_icon {
		background: {$color_scheme[2]};
		color: {$color_scheme[1]};
	}

	/* Working hours
	--------------------------------------- */
	.bt_bb_color_scheme_{$scheme_id} .btWorkingHours .btWorkingHoursInner .bt_bb_working_hours_inner_row .bt_bb_working_hours_inner_wrapper {
		color: currentColor !important;
	}
	.bt_bb_color_scheme_{$scheme_id}.btWorkingHours .btWorkingHoursInner .bt_bb_working_hours_inner_row .bt_bb_working_hours_inner_wrapper .bt_bb_working_hours_inner_link a {
		color: {$color_scheme[1]} !important;
		background: {$color_scheme[2]} !important;
	}

	/* Post & Portfolio grid
	--------------------------------------- */
	.bt_bb_masonry_post_grid .bt_bb_grid_item_read_more.bt_bb_read_more_icon_color_scheme_{$scheme_id} a,
	.bt_bb_masonry_portfolio_grid .bt_bb_grid_item_read_more.bt_bb_read_more_icon_color_scheme_{$scheme_id} a {
		color: {$color_scheme[2]};
	}
	.bt_bb_masonry_post_grid .bt_bb_grid_item_read_more.bt_bb_read_more_icon_color_scheme_{$scheme_id} a .bt_bb_grid_item_icon,
	.bt_bb_masonry_portfolio_grid .bt_bb_grid_item_read_more.bt_bb_read_more_icon_color_scheme_{$scheme_id} a .bt_bb_grid_item_icon {
		background: {$color_scheme[2]};
		color: {$color_scheme[1]};
	}

	/* Headline
	--------------------------------------- */
	.bt_bb_color_scheme_{$scheme_id} .bt_bb_headline h1,
	.bt_bb_color_scheme_{$scheme_id} .bt_bb_headline h2,
	.bt_bb_color_scheme_{$scheme_id} .bt_bb_headline h3,
	.bt_bb_color_scheme_{$scheme_id} .bt_bb_headline h4,
	.bt_bb_color_scheme_{$scheme_id} .bt_bb_headline h5,
	.bt_bb_color_scheme_{$scheme_id} .bt_bb_headline h6,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_headline h1,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_headline h2,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_headline h3,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_headline h4,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_headline h5,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_headline h6 {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id} .bt_bb_headline .bt_bb_headline_superheadline,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_headline .bt_bb_headline_superheadline {
		color: {$color_scheme[1]};
	}
	.bt_bb_color_scheme_{$scheme_id} .bt_bb_headline .bt_bb_headline_subheadline,
	.bt_bb_color_scheme_{$scheme_id}.bt_bb_headline .bt_bb_headline_subheadline {
		color: {$color_scheme[1]};
	}

";