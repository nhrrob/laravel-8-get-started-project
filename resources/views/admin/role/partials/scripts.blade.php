<!-- jQuery is not included in the layout : Users may add their own version as per project; This project is more like a template/ starter kit -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
        //alert('hello');
        $('#checkPermissionAll').click(function(){
            if($(this).is(':checked')){
                $('input[type=checkbox]').prop('checked', true);
            }else{
                $('input[type=checkbox]').prop('checked', false);
            }
        });
    });


    function checkPermissionByGroup(className, checkThis){
        const groupIdName = $("#"+checkThis.id);
        const classCheckbox = $("."+className+" input");

        if($(groupIdName).is(':checked')){
            classCheckbox.prop('checked', true);
        }else{
            classCheckbox.prop('checked', false);
        }

        implementAllChecked();
    }

    function checkSinglePermission(groupClassName, groupId, countTotalPermission){
        const classCheckbox = $("."+groupClassName+ " input");
        const groupIdCheckbox = $("#"+groupId);

        if($("."+groupClassName+" input:checked").length == countTotalPermission){
        groupIdCheckbox.prop('checked', true);
        }else{
        groupIdCheckbox.prop('checked', false);
        }

        implementAllChecked();
    }

    function implementAllChecked(){
        const countPermissions = {{count($allPermissions)}};
        const countPermissionGroups = {{count($permissionGroups)}};

        //console.log((countPermissions + countPermissionGroups) , $('input[type="checkbox"]:checked' ).length);

        if($('input[type="checkbox"]:checked' ).length >=  (countPermissions + countPermissionGroups)){
        $("#checkPermissionAll").prop('checked', true);
        }else{
        $("#checkPermissionAll").prop('checked', false);
        }
    }
    
</script>