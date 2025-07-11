export function toggleDropdown() {
    const dropdown = document.getElementById('userDropdownMenu');
    dropdown.classList.toggle('hidden');
}

export function openModal(id) {
    document.getElementById(id)?.classList.remove('hidden');
}

export function closeModal(id) {
    document.getElementById(id)?.classList.add('hidden');
}

export function switchModal(currentId, targetId) {
    closeModal(currentId);
    openModal(targetId);
}

// Cerrar dropdown si se hace clic fuera
window.addEventListener('click', function (e) {
    const dropdown = document.getElementById('userDropdownMenu');
    const button = document.getElementById('userDropdownButton');
    if (dropdown && button && !button.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.classList.add('hidden');
    }
});
