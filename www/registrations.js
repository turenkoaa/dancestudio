$(document).ready(function()
{
    var table_reg_detail_train;
     $('#getSelections').click(function getSelections(){
            var ss = [];
            var rows = table_reg_detail_train.datagrid('getSelections');
            if (rows){
            $.messager.confirm('Подтвердите','Отметить как посещенные?',function(r){
                    if (r){
                        for(var i=0; i<rows.length; i++){
                            var row = rows[i];
                            ss.push(row.idRegisterings);
                            }
                        //$.messager.alert('Info', ss.join('<br/>'));
                        $.post('set_visits.php',  { 'ss': ss.join(', ') },function(result){
                            if (result.success){
                               table_reg_detail_train.datagrid('reload');   // reload the user data
                            } else {
                                $.messager.show({   // show error message
                                    title: 'Error',
                                    msg: result.msg
                                });
                            }
                        },'json');
                    }
                });
            } 
        });
     
          $('#removeSelections').click(function getSelections(){
            var ss = [];
            var rows = table_reg_detail_train.datagrid('getSelections');
            if (rows){
            $.messager.confirm('Подтвердите','Отменить выбранные записи?',function(r){
                    if (r){
                        for(var i=0; i<rows.length; i++){
                            var row = rows[i];
                            ss.push(row.idRegisterings);
                            }
                        $.post('destroy_registration.php',  { 'ss': ss.join(', ') },function(result){
                            if (result.success){
                                $('#table_registration').datagrid('reload');   // reload the user data
                            } else {
                                $.messager.show({   // show error message
                                    title: 'Error',
                                    msg: result.msg
                                });
                            }
                        },'json');
                    }
                });
            } 
        });
    
    $('#btnNewRegistr').click(function saveUser(){
			$('#fmNewRegistr').form('submit',{
				url: 'add_registr_of_client.php',
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#fmNewRegistr').form('clear');
                        $('#table_registration').datagrid('reload');
                        $.messager.show({
							msg:'Запись на занятие.'
						});
					} else {
						$.messager.show({
							title: 'Ошибка',
							msg: result.msg
						});
					}
				}
			});
    });
    
    $('#table_registration').datagrid({
        title:'Записи',
        pagination:true,
        height:'100%',
        fitColumns:true,
        singleSelect:true,
        toolbar:'#tbGetSelections',
        columns:[[
               {field:'dateReg',title:'Дата',width:500},
             ]],
        url:'get_dates_reg.php',
        view: detailview,
        detailFormatter:function(index,row){
            return '<div style="padding:2px"><table class="table_reg_detail_train"></table></div>';
        },
        onExpandRow: function(index,row){
            table_reg_detail_train = $(this).datagrid('getRowDetail',index).find('table.table_reg_detail_train');
            table_reg_detail_train.datagrid({
                url:'get_trains_reg.php?dateReg='+row.dateReg,
                fitColumns:true,
                loadMsg:'',
                height:'auto',
                view:groupview,
                groupField:'nameSt',
                groupFormatter:function(value,rows){
                           return value;//.slice(0, -3);
                    },                          
                columns:[[
                    {field:'ck',checkbox:true},
                    {field:'idRegisterings',title:'id',width:100, hidden:true}, 
                    {field:'nameSt',title:'Тренировка',width:100,hidden:true}, 
                    {field:'client',title:'Клиент',width:100}, 
                    {field:'start',title:'Начало тренировки',width:100,formatter:function(val,row){
		return val.slice(0,-3);}},
                    //{field:'dayOfWeek',title:'День недели',width:40}, 
                    //{field:'numberOfGum',title:'Номер зала',width:100},
                    {field:'isVisit',title:'Посетил',width:10}
                ]],
                onResize:function(){
                    $('#table_registration').datagrid('fixDetailRowHeight',index);
                },
                onLoadSuccess:function(){
                    setTimeout(function(){
                        $('#table_registration').datagrid('fixDetailRowHeight',index);
                    },0);
                }
            });
            $('#table_registration').datagrid('fixDetailRowHeight',index);
            }
    });
    $('#table_reg_detail_train').datagrid('getPanel').addClass("lines-bottom");
    
    
});