$(document).ready(function() {
 /*   var gum = [
		    {gum:'1'}
		];*/
    $('#tableTimetable').datagrid({
                url:'get_timetable.php',
                pagination:'true',
                toolbar:'#tbTimetable',
                title:'Расписание',                                                   
                width:'100%',
                height:'auto',
                singleSelect:true, 
                fitColumns:true,
                view:groupview,
                groupField:'dayOfWeek',
                groupFormatter:function(value,rows){
                    switch (value) {
                            case 'Mon': return 'Понедельник'
                            case 'Tue': return 'Вторник'
                            case 'Wed': return 'Среда'
                            case 'Thu': return 'Четверг'
                            case 'Fri': return 'Пятница'
                            case 'Sat': return 'Суббота'
                            case 'Sun': return 'Воскресенье'
                            }
                    },                                                   
                columns:[[
                        {field:'idTimetable',title:'id',width:0, hidden:true},
                        {field:'dayOfWeek',title:'День недели',width:0, hidden:true},
                        {field:'time',title:'Время',width:60},
                        {field:'train',title:'Тренировка',width:80},
                        {field:'numberOfGum',title:'Зал',width:60} 
                    ]]             
			});
        var url;

		$('#btnNewTimetable').click(function(){
            $('#comboTrainCoach').combobox('reload','comboTrainCoach.php');
            $('#comboTime').combobox('reload','comboTime.php');
			$('#dlgTimetable').dialog('open').dialog('setTitle','Новая тренировка');
			$('#fmTimetable').form('clear');
			url = 'save_timetable.php';
		});


		$('#btnEditTimetable').click(function() {
			var row = $('#tableTimetable').datagrid('getSelected');
			if (row){
                $('#comboTrainCoach').combobox('reload','comboTrainCoach.php');
                $('#comboTime').combobox('reload','comboTime.php');
				$('#dlgTimetable').dialog('open').dialog('setTitle','Изменить информацию');
				$('#fmTimetable').form('load',row);
				url = 'update_timetable.php?id='+row.idTimetable;
			}
        });                         
                                  
                                  
		$('#btnSaveTimetable').click(function saveUser(){
			$('#fmTimetable').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#dlgTimetable').dialog('close');		// close the dialog
						$('#tableTimetable').datagrid('reload');
                        $('#comboTrains').combobox('reload','get_combotrains_for_reg.php'); 
					} else {
						$.messager.show({
							title: 'Ошибка',
							msg: result.msg
						});
					}
				}
			});
		});
               
		$('#btnRemoveTimetable').click(function() {
			var row = $('#tableTimetable').datagrid('getSelected');
			if (row){
				$.messager.confirm('Подтвердите','Удалить тренировку?',function(r){
					if (r){
						$.post('remove_timetable.php',{id:row.idTimetable},function(result){
							if (result.success){
								$('#tableTimetable').datagrid('reload');
                                $('#comboTrains').combobox('reload','get_combotrains_for_reg.php'); 
							} else {
								$.messager.show({	
									title: 'Ошибка',
									msg: result.msg
								});
							}
						},'json');
					}
				});
			}
		});
    
    		$('#btnPrintTimetable').click(function() {
				$.post("printtimetable.php", {}, function(result){
                    var result=eval('('+result+')');
                    $.messager.show({	
									title: 'Загрузка',
									msg: result.msg
								});
                } );
				});
});