function guardar_paciente() {


    nombre = $("#nombre").val();
    apellidos = $("#apellidos").val();
    edad = $("#edad").val();
    direccion = $("#direccion").val();
    telefono = $("#telefono").val();
    fecha = $("#fecha").val();

    var valores = {
        "nombre": nombre,
        "apellidos": apellidos,
        "edad": edad,
        "direccion": direccion,
        "telefono": telefono,
        "fecha": fecha
    };



    $.ajax({

        url: "guardarPaciente.php",
        type: 'POST',
        dataType: "html",
        data: valores,

        beforeSend: function() {

        },
        success: function(data, textStatus, xhr) {
            // $("#tabla_pacientes").append(data);

            html = '<tr id="' + data + '">';

            html = html + '<td>' + data + '</td><td>' + nombre + '</td><td>' + '</td><td>' + apellidos + '</td><td>' + '</td><td>' + edad + '</td><td>' + direccion + '</td><td>' + telefono + '</td><td>' + fecha + '</td>';

            html = html + '<td><a href="index.php?operacion=editar&nume=' + data + '" class="btn btn-info" role="button">Modificar</a></td>';

            html = html + '<td><a href="index.php?operacion=borrar&nume=' + data + '" class="btn btn-danger" role="button">Eliminar</a></td>';

            html = html + '<td><a href="listarTest.php?idPaciente=' + data + '" class="btn btn-warning" role="button">Ver</a></td>';

            html = html + '</tr>';
            $("#tabla_pacientes").append(html);

        },

        error: function(xhr, textStatus, errorThrown) {
            alert(xhr.responseText);
            alert(textStatus);
            alert(errorThrown);
            console.info(xhr.responseText);
        }

    });



    return false;

}


function modificar_paciente() {


    id = $("#id").val();
    nombre = $("#nombre").val();
    apellidos = $("#apellidos").val();
    edad = $("#edad").val();
    direccion = $("#direccion").val();
    telefono = $("#telefono").val();
    fecha = $("#fecha").val();

    var valores = {
        "id": id,
        "nombre": nombre,
        "apellidos": apellidos,
        "edad": edad,
        "direccion": direccion,
        "telefono": telefono,
        "fecha": fecha
    };



    $.ajax({

        url: "modificarPaciente.php",
        type: 'POST',
        dataType: "html",
        data: valores,

        beforeSend: function() {

        },
        success: function(data, textStatus, xhr) {

            fila = '#' + id;
            $(fila).append(data);

        },

        error: function(xhr, textStatus, errorThrown) {
            alert(xhr.responseText);
            alert(textStatus);
            alert(errorThrown);
            console.info(xhr.responseText);
        }

    });



    return false;

}