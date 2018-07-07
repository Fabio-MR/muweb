// ----------------------------------
// ----------------------------------
// Функции
// ----------------------------------

// Индикатор загрузки
loadStart = function() { $("#loading").show(); }
loadStop = function() { $("#loading").hide(); }

// Всплывающие окно по верх сайта
show_popup = function() {
  $(".show-popup").click(function(){
    $(this).togglePopup();
    return false;
  });
}
// Закрыть всплываюшие окно
close_popup = function() {
  $("#popup-close").click(function(){
    $('#opaco-box').removeAttr('style').unbind('click');
    $('#popup-box').removeAttr('style');
  });
}
close_element = function() {
  $("#element-close").click(function(){
    $('#popup-element').removeAttr('style');
  });
}
// Всплывающая подсказка вместо атрибута title 
help_text = function() {

  $(".help_text").bind({
    mouseover: function(){
      var txt = $(this).attr('title');
    
      $(this).attr('title','');
      $("#tooltip").html(txt).show();
    },
    mousemove: function(mouse){

      var x = mouse.pageX+15;
      var y = mouse.pageY+15;
      var w_width = $(document).width();
      var t_width = $("#tooltip").width();

      if ((x+t_width+12)>w_width) x = w_width-t_width-12;
      $("#tooltip").css({left:x+'px', top:y+'px'});
    },
    mouseout: function(){
      $(this).attr('title',$("#tooltip").html());
      $("#tooltip").removeAttr('style');
    }
  });
}

function checkTime(i) {
  if (i<10) {
    i="0" + i;
  }
  return i;
}
// Тикающие время
function startTime() {

  serverdate.setSeconds(serverdate.getSeconds()+1);
  
  var h=serverdate.getHours();
  var m=serverdate.getMinutes();

  m=checkTime(m);
  $("#serve-clock").text( h+":"+m);
  t=setTimeout('startTime()',1000);
}

function is_numeric(num) {
  return !isNaN(num);
}
// Колкулятор вычесляюший статы
function stats_calc() {
  $points = $("#leveluppoint").text();
  
  $new = $(".stats_calc");
  
  // Статьи на данный момент
  $now = $(".stats_now"); 
  var $s=new Array();
  for ($i=0;$i<$now.length;$i++) {
    $s[$now.eq($i).attr('id')] = parseInt($now.eq($i).text());
  }
  
  // Делаем расчет при ввадении данных
  $(".stats_calc").bind('keyup keypress',function(e) {
    
    // Сумма введонных статов
    $total = 0;
    for ($i=0;$i<$new.length;$i++) {
      $st = parseInt($new.eq($i).val());
      if (is_numeric($st)) {
        $total += $st;
      }
    }
    
    $stat = $(this).attr('name');
    $num = parseInt($(this).val());
    
    if ($num<0) { $(this).val('') }
  
    if (!is_numeric($num)) { $num=0; }
    
    $output = $points-$total;
    
    if ($output>=0) {
      $("#leveluppoint").text($output);
      $("#"+$stat).text($s[$stat]+$num);
    } else {
      $("#leveluppoint").text('0');
      $("#"+$stat).text(($s[$stat]+$num)+$output);
      $(this).val($num+$output);
    }
    
  });
}
// Вычесление стоимости с процентом
function nds_calc(elem,option) {
  var $nds = parseInt($("#"+elem+"_nds").val());
  // Делаем расчет при ввадении данных
  $("#"+elem+"_calc").bind('keyup keypress',function(e) {

    $num = parseInt($(this).val());
    
    if ($num<0) { $(this).val('') }
  
    if (!is_numeric($num)) { $num=0; }
    
    if ($num>1 && $num<10) {
      $procent = 1;
    } else {
      $procent = parseInt(($num*$nds)/100);
    }
    
    if (option == 1) { $result = $num-$procent; } else { $result = $procent+$num; }
    
    if ($result>=0) {
      $("#"+elem+"_nds_result").val($result);
    } else {
      $("#"+elem+"_nds_result").val('0');
    }
    
  });
}
// Вычесление стоимость...
function currencyCalc() {
  // Делаем расчет при ввадении данных
  $(".moneyCalc").bind('keyup keypress',function(e) {
    
    $id = $(this).attr('id').split('_')[1];
    $num = parseInt($(this).val());

    if ($num<0) { $(this).val('') }
    if (!is_numeric($num)) { $num=0; }
    
    $currency = $('#currency_'+$id).val();
    
    $count = $num*$currency;
    $result = $count.toFixed(0);
    
    if ($result>=0) {
      $("#result_"+$id).val($result);
    } else {
      $("#result_"+$id).val('0');
    }
    
  });
}
// Информация о предмете 
item_info = function($attr) {

  $($attr).bind({

    mouseover: function(){
      var txt = $(this).attr('title');
    
      $(this).attr('title','');
      $("#itemTooltip").html(txt).show();
    },
    mousemove: function(mouse){

      var x = mouse.pageX+15;
      var y = mouse.pageY+15;
      var w_width = $(document).width();
      
      var winTop = $(document).scrollTop();
      var w_height = $(window).height();
      
      var t_width = $("#itemTooltip").width();
      var t_height = $("#itemTooltip").height();
      
      if ((x+t_width+12)>w_width) x = w_width-t_width-12;
      if ((y+t_height+12)>winTop+w_height) y = (winTop+w_height)-t_height-12;
      
      $("#itemTooltip").css({left:x+'px', top:y+'px'});
      
    },
    mouseout: function(){
      $(this).attr('title',$("#itemTooltip").html());
      $("#itemTooltip").removeAttr('style');
    }
  });
}
// Entregando objetos em conquistas
function achGive() {
  $(".ach-give").click(function(){
      attr = $(this).attr('id').split('_');
      
      loadStart();
    
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: 'type=5&id='+attr[1]+'&pg='+attr[0],
        dataType: "json",
        success: function (obj) {
          loadStop();
          if (obj.error) {
            alert(obj.error);
          } else {
            if (obj.done>0) $("#this_"+attr[1]).find('.ach-item-num').text(obj.done);
            else $("#this_"+attr[1]).hide('slow');
          }
        }
      });
      
      return false;
  });
}

// ----------------------------------
// jQuery загрузки
// ----------------------------------
// Удаление контента с сайта
$(function() {
  $(".delete").click(function(){
      attr = $(this).attr('id').split('_');
      
      if (confirm(lang[9])) {
        loadStart();
      
        $.ajax({
          type: 'post',
          url: 'ajax.php',
          data: 'type=3&id='+attr[1]+'&pg='+attr[0],
          dataType: "text",
          success: function (obj) {
            loadStop();
            if (obj) {
              alert(obj);
            } else {
              $("#this_"+attr[1]).fadeOut('slow');
              
              if (attr[0] == 'achiev') location.reload(true);
              
            }
          }
        });
      }
      return false;
  });
});
// Подтверждение контента
$(function() {
  $(".done").click(function(){
      attr = $(this).attr('id').split('_');
      
      loadStart();
    
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: 'type=4&id='+attr[1]+'&pg='+attr[0],
        dataType: "text",
        success: function (obj) {
          loadStop();
          if (obj) {
            alert(obj);
          } else {
           if (attr[0] == 'waiting' || attr[0] == 'achievement' || attr[0] == 'achiev-active') location.reload(true);
           else $("#this_"+attr[1]).hide('slow');
          }
        }
      });
      return false;
  });
});
// Делаем переход по ссылке
$(function() {
  $('.slink').change(function () {
    window.location = $(this).val();
  });
});
// Распределение статов, калькулятор и выбор персонажа
$(function() {
  $("#char-select-stats").change(function() {

      $char = $(this).val();

      loadStart();
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: 'type=6&char='+$char,
        dataType: "json",
        success: function (obj) {
          loadStop();
          
          if (obj.error) {
            alert(obj.error);
          } else {
          
            $(".stats_calc").val('');
            
            $("#leveluppoint").text(obj.points);
            $("#strength").text(obj.strength);
            $("#agility").text(obj.agility);
            $("#vitality").text(obj.vitality);
            $("#energy").text(obj.energy);
            
            if (obj.command) {
              $("#hide_command").slideDown(100);
              $("#command").text(obj.command);
            } else {
              $("#hide_command").slideUp(100);
            }
            
            stats_calc();
          }
        }
      });

  });
  
  stats_calc();
  
});
// Определяем стоимость
$(function() {
  $(".char-select").change(function() {
      
      $attr = $(this).attr('id').split('_');
      $char = $(this).val();

      loadStart();
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: 'type=7&pg='+$attr[0]+'&char='+$char,
        dataType: "json",
        success: function (obj) {
          loadStop();
          
          if (obj.cena) $("#cena").show();
          else $("#cena").hide();
          
          if ($attr[1] == 'zen') {
            $("#zen").text(obj.cena);
          } else if ($attr[1] == 'credit') {
            $("#credit").text(obj.cena);
          } 
          
          if ($attr[0] == 'kill') { // Определяем количество киллов
            $("#num_kill").text(obj.pkcount);
          } else if ($attr[0] == 'mapnumber') { // Мапа где находится в данный момент
            $("#this_map").text(obj.map);
          } else if ($attr[0] == 'achiev') {
            $("#rena").text(obj.rena);
          } else if ($attr[0] == 'greset') {
          
            if (obj.wait_dt) {
              $("#GRtime").text(obj.wait_dt).show();
              $("#GREnter").hide();
              voteTimer();
            } else {
              $("#GRtime").hide();
              $("#GREnter").show();
            }
          
          } else if ($attr[0] == 'reset') {
          
            $("#costlist").html(obj.resources);
            if (obj.resetKey) $("#resetKey").show(); else $("#resetKey").hide();
            
          } /*else if ($attr[0] == 'resets') {
          
            $("#rena").text(obj.rena);
            
          }*/

        }
      });

  }); 
});

$(function() {
  $(".confirm").click(function(){
    $id = $(this).attr('id');
  
    if ($id == 'changeitem') {
      $text = lang[11];
    } else if ($id == 'burse') {
      $text = lang[12];
    } else if ($id == 'clearbank') {
      $text = 'Вы уверены что хотите очистить банк?';
    } else if ($id == 'smithyCreate') {
      $text = 'Вы уверены, что желаете приобрести это предмет?';
    } else {
      $text = $(this).val();
    }
  
    if (confirm($text)) {
      return true;
    } else {
      return false;
    }
  });
});
// Подсказка для достижений
$(function() {
  $(".ach-job, .present-box > b").bind({
    mouseover: function(){
      $(this).next('.ach-help-text, .presents-hide').slideDown(100);

    },
    mouseout: function(){
      $(this).next('.ach-help-text, .presents-hide').slideUp(100);
    }
  });
});
// Вывод информации о поле
$(function() { 

  if ($(".inHelp").length>0) { $('body').append('<div id="viewInfo"></div>'); }
  var $content;
  
  $(".inHelp").bind({

    mouseenter: function(){ // При наводе 
    
      var $coord = $(this).offset();
      
      var $title = $(this).attr('placeholder');
      $content = $(this).attr('title');
      $(this).attr('title','');
      
      ftop = $coord.top + ($(this).height())-26; 
      fleft = $coord.left + ($(this).outerWidth())+9;
      
      $("#viewInfo").css({left:fleft+'px', top:ftop+'px'});
      
         
      $("#viewInfo").html('<h4>'+$title+'</h4><p>'+$content+'</p>').fadeIn("slow");
 
    },
    mouseleave: function(){
      $(this).attr('title',$content);
      $("#viewInfo").removeAttr('style').text('');
    }
  });
    
});
// Информация о пентограме (Alt+Mouse Right Key)
$(function() {

  $(document).keydown(function(e) {
      
    
    $(".elementInfo").unbind('contextmenu');
    
    if(e.keyCode == 18) {
      $(".elementInfo").bind("contextmenu",function(event){
        $(".elementInfo").unbind('contextmenu');
        
        $var = $(this).attr('attr-element-var');
        
        // Показиваем/Прячем блок 
        if (!$('#popup-box').is(":animated")) {

          if($('#popup-box').is(":hidden")) {

            loadStart();
            
            $.post("ajax.php", {type:16, var:$var, server:serverSelected}, function(data){
              loadStop();
              if (data) {
                $('#popup-box').html(data).fadeIn('slow');
                      
                close_popup();
                item_info('.itemsInfo');
                
                
                if ($('#popup-box').height() > $(window).height()) {
                  
                  $win = parseInt($(window).scrollTop());
                  
                  $('#popup-box').css({
                  "position":"absolute",
                  "margin-top": '+='+$win
                  });

                }


              } else {
                //$('#opaco-box').removeAttr('style').unbind('click');
                alert('Data not found!');
              }
            });
            
          } else {

            //$('#opaco-box').removeAttr('style').unbind('click');
            $('#popup-box').removeAttr('style');
            
          }
          
        }     

        
        return false;
      });
    }
    
    //e.preventDefault();
    //return false;

   });
  
});
// Поиск пользователей / гильдий ...
$(function() {
  $(".search-form .search-box").bind('keydown keyup',function(e) { // определяем события на которые нужно реагировать
    
    var $search = $(this).val();
    
    if ($search.length>2) {
    
      var $el = $(this).parent().parent(".search-form");
        
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: $el.serialize(),
        dataType: "json",
        success: function (obj) {

          if (obj.length>0) {
          
            $s = '<ul>';
            $.each(obj, function($i, $r){
              $s += '<li>'+$r.name+'</li>';
            });
            $s += '</ul>';
            
            $el.find(".search-result").html($s).show();
          } else {
            $el.find(".search-result").hide();
          }
          
          
          $(".search-result li").click(function() {
            $name = $(this).text();
            $el.find(".search-box").val($name);
            $el.find(".search-result").hide();
            return false;
          });
          
          $("body").click(function() { $(".search-result").hide(); });
            
        }
      });

        
    }

  });
});
// Потделка select
$(function() {
    $(".select-imitation").click(function(e){
    
      $(".select-imitation-list").slideUp(100);
      
      id = $(this).attr('id');
      
      if (!$('#'+id+'-list').is(":animated")) {
        $('#'+id+'-list').slideToggle('slow');     
      }
      e.stopPropagation();
    });
         
    $("body").click(function(){ // При клики кудалибо закриваем список
        $(".select-imitation-list").slideUp(100);
    });
});
// Передвежение Расписание ивентов
$(function() {
  $(".event-scroll").click(function(e){
  
    var $num = $("#events").find('li').length
    var $max = 22 * $num;
    var $top = $("#events").scrollTop();
    var $height = $(".event").outerHeight()+4;
    
    
    if (!$('#events').is(":animated")) {
      $scroll = $top+$height;
      if ($scroll>=$max) $scroll = 0;
      $('#events').animate({scrollTop: $scroll});
    }
    
    console.log($max, $scroll);
    
  });
});
// ----------------------------------
// Плагины
// ----------------------------------
// Располагаем блок по центру
$.fn.alignCenter = function() {
  var marginLeft =  - $(this).width()/2 + 'px';
  var marginTop =  - $(this).height()/2 + 'px';
  //return $(this).css({'margin-left':marginLeft, 'margin-top':marginTop, 'top':0}).animate({'top':'50%'},250);
  return $(this).css({'margin-left':marginLeft, 'margin-top':marginTop});
};
// Показиваем/Прячем блок 
$.fn.togglePopup = function(){
  if (!$('#popup-box').is(":animated")) {

    if($('#popup-box').is(":hidden")) {
      $('#opaco-box').height($(document).height()).fadeTo('slow', 0.5).click(function(){$(this).togglePopup();});
      //$('#opaco-box').height($(document).height()).show().click(function(){$(this).togglePopup();});

      var attr = $(this).attr('id');
      loadStart();
      
      $.get("ajax.php", {type:1, pg:attr}, function(data){
        loadStop();
        if (data) {
          $('#popup-box').html(data).show().alignCenter();
          //$('#popup-box').html(data).fadeIn('slow');
          
          close_popup();
          
          item_info('.itemsInfo');
          achGive();
          nds_calc('market', 0);

          if ($('#popup-box').height() > $(window).height()) {
            $win = parseInt($(window).scrollTop());
            $('#popup-box').css({"position":"absolute", "margin-top": $win}); // , "margin-top": '+='+$win
          }

        } else {
          $('#opaco-box').removeAttr('style').unbind('click');
          alert('Data not found!');
        }
        
      });
      
    } else {

      $('#opaco-box').removeAttr('style').unbind('click');
      $('#popup-box').removeAttr('style');
      
    }
    
  }
};
$.fn.Timers = function (date) {

  var timeDifference = function(begin, end) {
      if (end < begin) {
        return false;
      }
      var diff = {
        seconds: [end.getSeconds() - begin.getSeconds(), 60],
        minutes: [end.getMinutes() - begin.getMinutes(), 60],
        hours: [end.getHours() - begin.getHours(), 24],
        days: [end.getDate()  - begin.getDate(), new Date(begin.getYear(), begin.getMonth() + 1, 0).getDate()],
      };
      var result = new Array();
      var flag = false;
      for (i in diff) {
        if (flag) {
          diff[i][0]--;
          flag = false;
        }    	
        if (diff[i][0] < 0) {
          flag = true;
          diff[i][0] += diff[i][1];
        }
        if (i=='days' && !diff[i][0]) continue;
        
        //if (i=='days') result.push(checkTime(diff[i][0]));
        result.push(checkTime(diff[i][0]));
      }
      return result.reverse().join(':');
  };
  var elem = $(this);
  var timeUpdate = function () {
      var s = timeDifference(serverdate, date);
      if (s.length) {
        elem.html(s);
      } else {
        clearInterval(timer);
        location.reload(true);
      }		
  };
  timeUpdate();
  var timer = setInterval(timeUpdate, 1000);		
};
// Вкладки
$.fn.lightTabs = function(options){

  var createTabs = function(){
    var $tabs = $(this);
    i = 0;
    
    showPage = function(i, elem){
      elem.children("div").children("div").hide();
      elem.children("div").children("div").eq(i).show();
      elem.children("ul").children("li").removeClass("active");
      elem.children("ul").children("li").eq(i).addClass("active");
    }
              
    showPage(0, $tabs);
    
    $tabs.children("ul").children("li").each(function(index, element){
      $(element).attr("data-page", i);
      i++;                        
    });
    
    $tabs.children("ul").children("li").click(function(){
      showPage(parseInt($(this).attr("data-page")), $tabs);
    });				
  };		
  return this.each(createTabs);
};	
// Доска
$.fn.changeWords = function(options) {
  var settings = $.extend({
    time: 3000,
    selector: "span",
    repeat: true
  }, options);
  
  var words = $(this).children();
  var wordCount = words.size();
  
  if (wordCount>1) {
  
    words.filter(function() {
      return $(this).data("id") != "1"
    }).css("display", "none");
    var count = 1;
    var changeThisWord = setInterval(function() {
      ++count;
      var wordOrder = count;
      words.filter(function() {
        return $(this).data("id") == wordOrder
      }).fadeIn(settings.time/2);
      words.filter(function() {
        return $(this).data("id") != wordOrder
      }).fadeOut(settings.time/2).removeClass();
      if (count == wordCount) {
        count = 0;
      }
      if(count == 0 && settings.repeat != true)
      {
        clearInterval(changeThisWord);
      }
    }, settings.time);
    
  }
}
// -------------------------------------------------
// Запускаем скрипты по окончанию загрузки страницы
// -------------------------------------------------

$(document).ready(function(){ 
  $(".tabs, .wh-tabs, .inv-tabs").lightTabs();

  if ($(".itemInfo, #achievement").length>0) { $('body').append('<div id="itemTooltip"></div>'); }
  item_info('.itemInfo');
  
  if ($(".notice-popup").length>0) { setTimeout('$(".notice-popup").togglePopup()', 1000); }
  
  if ($('#videoFadeIn').length>0) { // Плавный запуск видео
  
    var $video = $('#videoFadeIn');
    

    $video.html('<video loop muted autoplay><source src="templates/blue/images/video/norebirth.mp4" type="video/mp4"><source src="images/video/norebirth.ogv" type="video/ogv"><source src="images/video/norebirth.webm" type="video/webm"></video>');
    $video.hide(); 
    
    setTimeout(function() { // Плавный запуск видео
        $video.fadeIn(1500); 
    }, 2500);
    
  }
  
  
  show_popup();
  help_text();
  startTime();
  
	//-------------------------------------------------
	//Circle скрипт для онлайна
	//-------------------------------------------------
	$('.status .item').each(function(index, el) {
	    $(el).find('.circle').circleProgress({
	        value: $(el).attr('data-online')/$(el).attr('data-max-online'),
	        size: 144,
	        startAngle: -1.54,
	        thickness: 12,
	        emptyFill: 'rgba(0,0,0,0.36)',
	        fill: {
	          image:'./images/status-load.png'
	        }
	    });
	});
});