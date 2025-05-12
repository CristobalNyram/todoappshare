function sessionClose()
{
    $.post('login/logout.php',
    {
    }, respuestaSalir, 'json');
}

function respuestaSalir(arg)
{
    setTimeout("location.href='index.php'", 2);
}


function courseRegisterAll(idcurso)
{
    $.ajax({
        type     : "POST",
        dataType : "json",
        url      : "../CapaDatos/Cursos/CursosRegisterSave.php",
        cache    : false,
        async    : false, 
        data:
        {
            cursoNameDat : idcurso
        },
        success: function (data)
        {        
            //alertaUIFin();               
            if(data.respuesta == "Exito")
            {         
               window.location.href = data.url+'index.php?idCurso='+idcurso;
            }
            else
            {
                if (data.respuesta == 'Solo una vez te puedes registrar en el curso.')
                {
                    alert(data.respuesta);
                }
                else 
                {
                    window.location.href = '../account/register.php';  
                }  
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {      
            //setAlertaMessage('Notificar al Administrador:  Error al invocar al servicio mostrarActividadesCursoEstudiante.', "error")
        }
    });
}