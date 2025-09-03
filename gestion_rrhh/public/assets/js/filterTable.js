
document.addEventListener('DOMContentLoaded', function() {
    const teamFilter = document.getElementById('teamFilter');
    const table = document.querySelector('.table-striped tbody');
    if (table) {
    const rows = table.querySelectorAll('tr');

    // Obtener las opciones únicas de equipos y agregar al select
    const teams = new Set();
    rows.forEach(row => {
        const teamName = row.cells[3].textContent.trim();
        if (teamName) {
            teams.add(teamName);
        }
    });

    teams.forEach(team => {
        const option = document.createElement('option');
        option.value = team;
        option.textContent = team;
        teamFilter.appendChild(option);
    });
}
});

function filterTableByTeam() {
    const teamFilter = document.getElementById('teamFilter');
    const selectedTeam = teamFilter.value;
    const table = document.querySelector('.table-striped tbody');
    const rows = table.querySelectorAll('tr');

    rows.forEach(row => {
        const teamName = row.cells[3].textContent.trim();
        if (selectedTeam === '' || teamName === selectedTeam) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}