$(document).ready(function() {
    $('#tableStaff').datagrid({
                url:'get_staff.php',
                pagination:'true',
                toolbar:'#tbStaff',
                title:'Сотрудники',                                                   
                width:'100%',
                height:'100%',
                singleSelect:true, 
                fitColumns:true,  
                striped:'true',

                columns:[[
                        {field:'idStaff',title:'id',width:0, hidden:true},
                        {field:'surnameSt',title:'Фамилия',sortable:'true',width:100},
                        {field:'nameSt',title:'Имя', sortable:'true',width:100},                                                                                 {field:'middleNameSt',title:'Отчество',width:100},
                        {field:'passportSt',title:'Паспорт',width:100},
                        {field:'post',title:'Должность',sortable:'true',width:100},
                        {field:'dateOfBirthSt',title:'Дата рождения',width:100},
                        {field:'genderSt',title:'Пол',width:60},
                        {field:'phoneSt',title:'Телефон',width:100},
                        {field:'emailSt',title:'e-mail',width:100},
                        
                    ]],            
			});
                var url;

		$('#btnNewStaff').click(function(){
			$('#dlgStaff').dialog('open').dialog('setTitle','Новая тренировка');
			$('#fmStaff').form('clear');
			url = 'save_staff.php';
		});


		$('#btnEditStaff').click(function() {
			var row = $('#tableStaff').datagrid('getSelected');
			if (row){
				$('#dlgStaff').dialog('open').dialog('setTitle','Изменить информацию');
				$('#fmStaff').form('load',row);
				url = 'update_staff.php?id='+row.idStaff;
			}
        });                         
                                  
                                  
		$('#btnSaveStaff').click(function saveUser(){
			$('#fmStaff').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#dlgStaff').dialog('close');		// close the dialog
						$('#tableStaff').datagrid('reload');	// reload the user data
					} else {
						$.messager.show({
							title: 'Ошибка',
							msg: result.msg
						});
					}
				}
			});
		});
               
		$('#btnRemoveStaff').click(function() {
			var row = $('#tableStaff').datagrid('getSelected');
			if (row){
				$.messager.confirm('Подтвердите','Уволить сотрудника?',function(r){
					if (r){
						$.post('remove_staff.php',{id:row.idStaff},function(result){
							if (result.success){
								$('#tableStaff').datagrid('reload');	// reload the user data
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