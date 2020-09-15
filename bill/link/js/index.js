$(document).ready(function() {

    $('.search2').each(function() {

        var self = $(this);
        var form = self.children('form');
        var input = form.children('input');
        var span = $('<span />').appendTo(form);
        var bar2 = self.children('.bar2');
        var close2 = self.children('.close2');
       // var list = self.children('ul');
        var list = self.siblings('ul');

        input.keypress(function (e) {
            if(e.which && e.charCode) {
                resizeForText(input, span, $(this).val() + String.fromCharCode(e.keyCode | e.charCode));
            }
        });

        input.keyup(function(e) {
            if(e.keyCode === 8 || e.keyCode === 46) {
                resizeForText(input, span, $(this).val());
            }
        });

        resizeForText(input, span, self.val());

        form.submit(function(e) {
            e.preventDefault();
            if(!self.hasClass('prepare')) {
                input.blur();
                $('<span />').text(input.val()).appendTo(bar2);
                self.addClass('prepare submit');
                setTimeout(function() {
                    self.removeClass('submit');
                }, 200);
                setTimeout(function() {
                    self.addClass('animate');
                    bar2.animate({
                        width: (self.outerWidth() - 32)
                    }, 800, function() {
                        var search2W = ((list.outerWidth() + 32) > (72 + bar2.outerWidth())) ? (list.outerWidth() + 32) : 72 + bar2.outerWidth();
                        self.animate({
                            width: search2W
                        }, 400);
                        setTimeout(function() {
                            self.animate({
                                height: self.outerHeight() + list.outerHeight()
                            }, 500, function() {
                                list.css({'display':'block'});
								var sear = input.val();
								//////
									$.ajax({
										url:'ajax/filter.php',
										type:'post',
										data:{sear:sear},
										success:function(res){
											//alert(res);
											//list.addClass('show').html(res);
											$('.show').html(res);
										}
									});
								//////
                            });
                        }, 200);
                    });
                    setTimeout(function() {
                        self.addClass('done');
                    }, 800);
                }, 1250);
            }
        });

        close2.on('click', function(e) {
            self.removeClass('done');
            setTimeout(function() {
                input.val('');
                bar2.animate({
                    width: 32
                }, 1000, function() {
                    self.addClass('reset');
                    bar2.children('span').remove();
                    setTimeout(function() {
                        self.removeClass('animate reset prepare');
                        setTimeout(function() {
                            input.animate({
                                width: 32
                            }, 400, function() {
                                bar2.removeAttr('style');
                            });
                        }, 200);
                    }, 400);
                });
            //    list.removeClass('show');
				//$('.search2').css({'background':'red'});
				list.css({'display':'none'});
				list.removeClass('show');
                setTimeout(function() {
                    self.animate({
                        height: 62
                    }, 400, function() {
                        self.animate({
                            width: 92
                        }, 400, function() {
                            self.removeAttr('style');
                        });
                    });
                }, 200);
            }, 500);
        });

    });

});

function resizeForText(input, span, text) {
    text = (!text) ? ' ' : text;
    span.text(text);
    input.width(span.width());
}