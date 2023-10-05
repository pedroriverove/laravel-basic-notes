window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

function confirmationMessage(text, left, right) {
    return swal({
        title: '¿Está seguro?',
        text: text || '¿Realmente quieres borrar este registro?',
        icon: 'warning',
        buttons: [
            left || 'Cancelar',
            right || 'Eliminar'
        ],
        dangerMode: true,
    });
}

function successMessage(text) {
    return swal({
        title: '¡Éxito!',
        text: text || 'Se ha eliminado el registro',
        icon: 'success',
    });
}

function errorMessage(text) {
    return swal({
        title: '¡Error!',
        text: text || '¡Algo salió mal!',
        icon: 'error',
    });
}
