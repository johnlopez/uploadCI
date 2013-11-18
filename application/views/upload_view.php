<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style>
    
</style>
</head>

<body>
    <!--$ERROR MUESTRA LOS ERRORES QUE PUEDAN HABER AL SUBIR LA IMAGEN-->
    <?=@$error?>

    <span><?php echo validation_errors(); ?></span>

    



<?=form_open_multipart(base_url().'upload/do_upload');
//aqui se procesará nuestro formulario, controlador comentarios, función insertar_comentarios
//creamos los arrays que compondran nuestro formulario
//primer array con el input que se llamará nombre y será donde introduciremos el mismo
$titulo = array(
        'name' => 'titulo',
        'id' => 'titulo',
        'size' => '50',
        'style' => 'width:50%',
        'value' => set_value('titulo') // con esto al procesar el formulario de forma incorrecta quedará guardado el dato que le habíamos puesto
    );
 
//el segundo array(campo email)
 
   
    $userfile = array(
        'name' => 'userfile',
        'id' => 'userfile',
        'rows' => 10,
        'cols' => 40,
        'value' => set_value('userfile')
    );
 
//el botón submit de nuestro formulario
    $submit = array(
        'name' => 'submit',
        'id' => 'submit',
        'value' => 'Subir imágenes',
        'title' => 'Subir imágenes'
    );
    ?>
<?php
echo form_fieldset('Nuevo comentario');
?>
            <table>
                <tr>
                    <td>
                        <?php echo form_label('titulo: '); ?>
                    </td>
                    <td>
                        <?php echo form_input($titulo); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo form_label('userfile: '); ?>
                    </td>
                    <td>
                        <?php echo form_upload($userfile); ?>
                    </td>
                </tr>
                
                <tr>
                    <td>
 
                    </td>
                    <td>
<!--con la funcion validation_errors ci nos muestra los errores al pulsar el botón submit, la podemos colocar donde queramos-->
                  <font color="red" style="font-weight: bold; font-size: 14px; text-decoration: underline"><?php echo validation_errors(); ?></font>
                    </td>
                </tr>
                <tr>
                    <td>
 
                    </td>
                    <td>
                        <?php echo form_submit($submit);
                        //nuestro boton submit
                        ?>
                    </td>
                </tr>
                <?php
                echo form_close();
                ?>
        </table>
        <?php
               echo form_fieldset_close();
       ?>


</body>
</html>