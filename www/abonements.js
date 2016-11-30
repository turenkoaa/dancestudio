$(document).ready(function()
{
    var typesOfTrains = [
		    {type:'групповые'},
		    {type:'мини группа'},
		    {type:'персональные'}
		];
    $('#btnNewAbonement').click(function saveUser(){
			$('#fmNewAbonement').form('submit',{
				url: 'add_abonement_of_client.php',
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#fmNewAbonement').form('clear');
                        $.messager.show({
							msg:'Абонемент успешно оформлен.'
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

    
    $('#saveAbonement').click(function() {
        $('#typesAbonements').edatagrid('saveRow');
        setTimeout(function(){
            $('.comboAbonements').combobox('reload','get_comboabonements.php');
        }, 500);
    });
    $('#removeAbonement').click(function() {
        $('#typesAbonements').edatagrid('destroyRow');
        setTimeout(function(){
        $('.comboAbonements').combobox('reload','get_comboabonements.php');
        }, 1500);
    });
                
    $('#typesAbonements').edatagrid({
                url:'get_types_abonements.php',
				saveUrl: 'save_types_abonements.php',
				updateUrl: 'update_type_abonement.php',
				destroyUrl: 'destroy_type_abonement.php',
                width:'100%',
                height:'100%',
                toolbar:'#tbEdit',
                idField:'idAbonement',
                singleSelect:true,
                collapsible:true,
                rownumbers:false,
                fitColumns:true,
                view:groupview,
                groupField:'typeOfTrainings',
                groupFormatter:function(value,rows){
                           return value;
                        },
                pagination:{showPageList:false},
                columns:[[
                        {field:'idAbonement',title:'id',width:0,hidden:true},
                        {field:'nameAb',title:'Название',width:'20%',editor:{type:'validatebox',options:{required:true}}},
                        {field:'typeOfTrainings',title:'Тип',width:'15%',
                                          editor:{type:'combobox',
                                                options:{
                                                    valueField:'type',
                                                    textField:'type',
                                                    data:typesOfTrains,
                                                    panelHeight:'auto',  
                                                    required:true
                        }}},
                        {field:'priceAb',title:'Стоимость',width:'15%',align:'right', 
                                        editor:{type:'numberbox',options:{required:true}}},
                        {field:'numOfTrainings',title:'Число тренировок',width:'15%',align:'right',
                                        editor:{type:'numberbox',options:{required:true}}},
                        {field:'numActiveDays',title:'Число дней активности',width:'15%',align:'right', 
                                        editor:{type:'numberbox',options:{required:true}}},
                        {field:'sale',title:'Скидка',width:'15%',align:'right',
                                         editor:{type:'numberbox',options:{required:true}}}
                    ]]
			});
    
    
});