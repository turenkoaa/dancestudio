$(document).ready(function()
{
    //Опредеяем дополнительную информацию об абонементах клиента
        $('#dg').datagrid({
        view: detailview,
        rownumbers:true,
        fitColumns:true,
        detailFormatter:function(index,row){
                return '<div class="ddv" style="padding:5px 0"></div>';
        },
        onExpandRow: /*function(index,row){
                    var ddv = $(this).datagrid('getRowDetail',index).find('table.ddv');
                    ddv.datagrid({
                        url:'get_abonements.php?idClient='+row.idClient,
                        fitColumns:true,
                        loadMsg:'',
                        height:'auto',
                        columns:[[
                              {field:'nameAb',title:'Абонемент',width:100},
                              {field:'firstDate',title:'первый день',width:100,align:'right'},
                              {field:'statusAb',title:'статус',width:100},
                              {field:'countOfTrains',title:'число тренировок',width:100,align:'right'},
                              {field:'isPaid',title:'оплачено',width:100},
                                ]],
                        onResize:function(){
                            $('#dg').datagrid('fixDetailRowHeight',index);
                        },
                        onLoadSuccess:function(){
                            setTimeout(function(){
                                $('#dg').datagrid('fixDetailRowHeight',index);
                            },0);
                        }
                    });
                    $('#dg').datagrid('fixDetailRowHeight',index);
                }*/
            function(index,row){
        var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
            ddv.panel({
                height:'auto',
                border:false,
                cache:false,
                href:'get_abonements.php?idClient='+row.idClient,
                onLoad:function(){
                        $('#dg').datagrid('fixDetailRowHeight',index);
                }
            });
            $('#dg').datagrid('fixDetailRowHeight',index);
            }
        });

    
    var url;

		$('#btnNewClient').click(function(){
			$('#dlg').dialog('open').dialog('setTitle','Новый клиент');
			$('#fm').form('clear');
			url = 'save_user.php';
		});


		$('#btnEditClient').click(function() {
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Изменить информацию');
				$('#fm').form('load',row);
				url = 'update_user.php?id='+row.idClient;
			}
        });                         
                                  
                                  
		$('#btnSaveClient').click(function saveUser(){
			$('#fm').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#dlg').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');	// reload the user data
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
		});
               
		$('#btnRemoveClient').click(function() {
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Подтвердите','Удалить клиента?',function(r){
					if (r){
						$.post('remove_user.php',{id:row.idClient},function(result){
							if (result.success){
								$('#dg').datagrid('reload');	// reload the user data
							} else {
								$.messager.show({	// show error message
									title: 'Ошибка',
									msg: result.msg
								});
							}
						},'json');
					}
				});
			}
		});
    

});