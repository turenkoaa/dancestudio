$(document).ready(function() {
    var typesOfTrains = [
		    {type:'групповые'},
		    {type:'мини группа'},
		    {type:'персональные'}
		];
    $('#tableTrains').datagrid({
                url:'get_trains.php',
                //pagination:'true',
                toolbar:'#tbTrains',
                title:'Тренировки',                                                   
                width:'100%',
                height:'100%',
                singleSelect:true, 
                fitColumns:true,
                view:groupview,
                groupField:'typeOfTrain',
                groupFormatter:function(value,rows){
                           return value;
                    },                                                   
                columns:[[
                        {field:'idTrain',title:'id',width:60, hidden:true},
                        {field:'coachName',title:'Тренер',width:100},
                        {field:'nameSt',title:'Тренировка',width:100},
                        {field:'durationMinutes',title:'Продолжительность',width:80},
                        {field:'typeOfTrain',title:'Тип',width:100} 
                    ]]             
			});
        var url;

		$('#btnNewTrain').click(function(){
            $('#comboCoaches').combobox('reload','get_coaches.php');
            $('#comboStyles').combobox('reload','get_styles.php');
			$('#dlgTrain').dialog('open').dialog('setTitle','Новая тренировка');
			$('#fmTrain').form('clear');
			url = 'save_trains.php';
		});


		$('#btnEditTrain').click(function() {
			var row = $('#tableTrains').datagrid('getSelected');
			if (row){
                $('#comboCoaches').combobox('reload','get_coaches.php');
                $('#comboStyles').combobox('reload','get_styles.php');
				$('#dlgTrain').dialog('open').dialog('setTitle','Изменить информацию');
				$('#fmTrain').form('load',row);
				url = 'update_train.php?id='+row.idTrain;
			}
        });                         
                                  
                                  
		$('#btnSaveTrain').click(function saveUser(){
			$('#fmTrain').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#dlgTrain').dialog('close');		// close the dialog
						$('#tableTrains').datagrid('reload');	// reload the user data
					} else {
						$.messager.show({
							title: 'Ошибка',
							msg: result.msg
						});
					}
				}
			});
		});
               
		$('#btnRemoveTrain').click(function() {
			var row = $('#tableTrains').datagrid('getSelected');
			if (row){
				$.messager.confirm('Подтвердите','Удалить тренировки?',function(r){
					if (r){
						$.post('remove_train.php',{id:row.idTrain},function(result){
							if (result.success){
								$('#tableTrains').datagrid('reload');	// reload the user data
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