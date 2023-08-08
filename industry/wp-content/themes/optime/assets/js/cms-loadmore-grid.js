jQuery(document).ready(function ($) {
    "use strict";
    var pageNum = [],
        total = [],
        max = [],
        perpage = [],
        nextLink = [],
        masonry = [],
        newItems = [];
    $('.cms-grid').each(function () {
        var _this = $(this);
        var html_id = _this.attr('id');
        var _variable = window["cms_load_more_" + html_id];
        if (typeof _variable !== 'undefined') {
            pageNum[html_id] = parseInt(_variable.startPage) + 1;
            total[html_id] = parseInt(_variable.total);
            max[html_id] = parseInt(_variable.maxPages);
            perpage[html_id] = parseInt(_variable.perpage);
            nextLink[html_id] = _variable.nextLink;
            masonry[html_id] = _variable.layout;
            console.log(_variable);
            $('#' + html_id + ' .cms-load-more').on('click',function () {
                var _this_click = $(this);
                _this_click.find('i').attr('class', 'fa fa-refresh fa-spin');
                setTimeout(function () {
                    $.get(nextLink[html_id], function () {
                    })
                        .done(function (data) {
                            if (masonry[html_id] === 'masonry') {
                                var items = $(data).find('#' + html_id + ' .cms-grid-masonry > .grid-item');
                                var time = 0.4;
                                items.each(function () {
                                    $(this).addClass('cms-animated');
                                    $(this).find('.grid-item-inner').css('animation-duration', time + 's');
                                    time = time + 0.15;
                                });
                                $(items).imagesLoaded(function(){
                                    $('#' + html_id).children('.cms-grid-masonry').append(items);
                                    $.fn.cms_grid_refresh();
                                    $(document).find('.filter-item.active').trigger('click');
                                    $('.cms-services-grid img.svg').each(function(){
                                        var $img = jQuery(this);
                                        var imgID = $img.attr('id');
                                        var imgClass = $img.attr('class');
                                        var imgURL = $img.attr('src');

                                        $.get(imgURL, function(data) {
                                            // Get the SVG tag, ignore the rest
                                            var $svg = jQuery(data).find('svg');

                                            // Add replaced image's ID to the new SVG
                                            if(typeof imgID !== 'undefined') {
                                                $svg = $svg.attr('id', imgID);
                                            }
                                            // Add replaced image's classes to the new SVG
                                            if(typeof imgClass !== 'undefined') {
                                                $svg = $svg.attr('class', imgClass+' replaced-svg');
                                            }

                                            // Remove any invalid XML tags as per http://validator.w3.org
                                            $svg = $svg.removeAttr('xmlns:a');

                                            // Check if the viewport is set, if the viewport is not set the SVG wont't scale.
                                            if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                                                $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
                                            }

                                            // Replace image with new SVG
                                            $img.replaceWith($svg);

                                        }, 'xml');

                                    });
                                });
                            }
                            pageNum[html_id]++;
                            if (pageNum[html_id] <= max[html_id]) {
                                if (nextLink[html_id].indexOf('/page/') > -1) {
                                    nextLink[html_id] = nextLink[html_id].replace(/\/page\/[0-9]?/, '/page/' + pageNum[html_id]);
                                }
                                else {
                                    nextLink[html_id] = nextLink[html_id].replace(/paged=[0-9]?/, 'paged=' + pageNum[html_id]);
                                }
                            } else {
                                _this_click.remove();
                            }
                        })
                        .always(function () {
                            _this_click.find('i').attr('class', 'fa');
                        });
                }, 100);
            });
        }

        var _pagination_variable = $('#' + html_id).find('.cms-grid-pagination');
        if(typeof _pagination_variable !== 'undefined' || _pagination_variable.length > 0){
            $('#' + html_id + ' .cms-grid-pagination').on('click','.page-numbers',function (e) {
                e.preventDefault();
                var _this_page = $(this);
                if(_this_page.hasClass('current')){
                    return;
                }
                var _p_link = _this_page.attr('href');
                setTimeout(function () {
                    $.get(_p_link, function () {
                    })
                        .done(function (data) {
                            if (masonry[html_id] === 'masonry') {
                                var _contents = $(data).find('#' + html_id + ' .cms-grid-inner');
                                var _pagination = $(data).find('#' + html_id + ' .cms-grid-pagination');
                                var items = $(data).find('#' + html_id + ' .cms-grid-masonry > .grid-item');
                                var time = 0.4;
                                items.each(function () {
                                    $(this).addClass('cms-animated');
                                    $(this).find('.grid-item-inner').css('animation-duration', time + 's');
                                    time = time + 0.15;
                                });
                                $(items).imagesLoaded(function(){
                                    $('#' + html_id).children('.cms-grid-masonry').html(_contents.html());
                                    $('#' + html_id).find('.cms-grid-pagination').html(_pagination.html());
                                    document.getElementById(html_id).scrollIntoView({behavior: "smooth", block: "start", inline: "nearest"});
                                    $.fn.cms_grid_refresh();
                                    $(document).find('.filter-item.active').trigger('click');
                                    $('#' + html_id).find('.grid-item-inner').addClass('wpb_start_animation animated');
                                })
                            }
                        })
                        .always(function () {
                        });
                }, 100);
            });
        }
    });
});