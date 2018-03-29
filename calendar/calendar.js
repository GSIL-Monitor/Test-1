/*
* @Author: wusong
* @Date:   2017-12-07 11:30:13
* @Last Modified time: 2017-12-07 14:42:41
*/

jQuery.fn.extend({
    calendar:function(param){
        var obj = $(this);  // 当前操作对象
        var tagName = obj.prop("tagName");
        if(tagName !== 'INPUT')return false;    // 当前对象必须是input框
        obj.css("position",'absolute');

        obj.on('click',function(){
            // 加载日历框
            var calendar_str = loadCalendarHtml(2017,11,getMonthDays(2017,11));
            // 弹出框
            loadPopup(calendar_str);
        })

        // 加载弹出框
        function loadPopup(calendar_str)
        {
            // 获取input的宽
            var width = obj.css("width");
            var height = obj.css("height");
            var html = '<div style="position:relative;margin-top:'+height+';width:'+width+'">\
                '+calendar_str+'\
            </div>';
            obj.after(html)
        }

        // 获得某年某月的天数
        function getMonthDays(year,month){
            var monthStartDate = new Date(year, month, 1);
            var monthEndDate = new Date(year, month + 1, 1);
            var days = (monthEndDate - monthStartDate)/(1000 * 60 * 60 * 24);
            return days;
        }

        // 加载日历模块
        function loadCalendarHtml(year,month,days)
        {
            var calendar_str = '';
            for(var i = 1 ;i <= parseInt(days); i++)
            {
                if(i<10)i='0'+i;
                var nowmonth = month+1;
                if(nowmonth<10)nowmonth='0'+nowmonth;
                var date = year+'-'+nowmonth+'-'+i;
                var week = new Date(date).getDay();
                if(week == 0 || calendar_str == '')
                {
                    calendar_str += '<tr>';
                }
                if(calendar_str == '<tr>')
                {
                    for(var j = 0;j<parseInt(week);j++)
                    {
                        calendar_str += '<td></td>';
                    }
                }
                // 默认状态
                var open_close_text = '';
                var open_close_css = 'style="background:#FFF;"';
                // 查询数据库中是否选择了某个日期
                // if(id != '' && calendar_data.indexOf(date) != -1)
                // {
                //     open_close_text = '关闭';
                //     open_close_css = 'style="background:#DDD;"';
                // }
                // // 查询本地是否选择了某个日期
                // if(selected_date_id_value.indexOf(date) != -1)
                // {
                //     open_close_text = '开启';
                //     open_close_css = 'style="background:#FFF;"';
                // }
                // // 查询本地是否关闭了某个日期
                // if(deleted_date_id_value.indexOf(date) != -1)
                // {
                //     open_close_text = '关闭';
                //     open_close_css = 'style="background:#DDD;"';
                // }

                calendar_str += '<td align="center" '+open_close_css+'>' +
                    '<span id="'+date+'">'+i+'</span>' +
                    '<span style="cursor:pointer;color:#f96868;display:block;" onclick="pre_order_status_change()">'+open_close_text+'</span></td>';
                if(week == 6)calendar_str += '</tr>'
            }
            var html = '<table id="calendar_table" style="width:100%;">\
                            <thead>\
                                <tr>\
                                    <th style="text-align:center;">周日</th>\
                                    <th style="text-align:center;">周一</th>\
                                    <th style="text-align:center;">周二</th>\
                                    <th style="text-align:center;">周三</th>\
                                    <th style="text-align:center;">周四</th>\
                                    <th style="text-align:center;">周五</th>\
                                    <th style="text-align:center;">周六</th>\
                                </tr>\
                            </thead>\
                            <tbody>\
                            '+calendar_str+'\
                            </tbody>\
                        </table>';
            return html;
        }
    }
});