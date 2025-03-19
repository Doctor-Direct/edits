let doctors = [];
let hospitals = [];
let patients = [];

// Navigation
document.querySelectorAll('.nav-item').forEach(item => {
    item.addEventListener('click', () => {
        // Update active nav item
        document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
        item.classList.add('active');

        // Show corresponding section
        document.querySelectorAll('.section').forEach(section => section.classList.remove('active'));
        document.getElementById(item.dataset.section).classList.add('active');
    });
});

// Form Handling
function showForm(type) {
    const modal = document.getElementById('modal');
    const forms = document.querySelectorAll('.form');
    forms.forEach(form => form.classList.remove('active'));
    document.getElementById(`${type}Form`).classList.add('active');
    modal.classList.add('active');
}

function hideForm() {
    const modal = document.getElementById('modal');
    modal.classList.remove('active');
    document.querySelectorAll('form').forEach(form => form.reset());
}

// Form Submissions
document.getElementById('doctorForm').addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    const doctor = {
        id: Date.now().toString(),
        name: formData.get('name'),
        specialization: formData.get('specialization'),
        location: formData.get('location'),
        experience: parseInt(formData.get('experience'))
    };
    doctors.push(doctor);
    hideForm();
    renderDoctors();
});

document.getElementById('hospitalForm').addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    const hospital = {
        id: Date.now().toString(),
        name: formData.get('name'),
        location: formData.get('location'),
        type: formData.get('type'),
        facilities: formData.get('facilities').split(',').map(f => f.trim())
    };
    hospitals.push(hospital);
    hideForm();
    renderHospitals();
});

document.getElementById('patientForm').addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    const patient = {
        id: Date.now().toString(),
        name: formData.get('name'),
        age: parseInt(formData.get('age')),
        contact: formData.get('contact'),
        medicalHistory: formData.get('medicalHistory').split('\n')
    };
    patients.push(patient);
    hideForm();
    renderPatients();
});

// Location Filters
document.getElementById('doctorLocationFilter').addEventListener('change', (e) => {
    renderDoctors(e.target.value);
});

document.getElementById('hospitalLocationFilter').addEventListener('change', (e) => {
    renderHospitals(e.target.value);
});

// Render Functions
function renderDoctors(locationFilter = '') {
    const list = document.getElementById('doctorsList');
    const filteredDoctors = locationFilter 
        ? doctors.filter(d => d.location === locationFilter)
        : doctors;

    list.innerHTML = filteredDoctors.map(doctor => `
        <div class="list-item">
            <div class="list-item-header">
                <h3 class="list-item-title">${doctor.name}</h3>
                <div class="list-item-actions">
                    <button class="delete-btn" onclick="deleteDoctor('${doctor.id}')">Delete</button>
                </div>
            </div>
            <p>Specialization: ${doctor.specialization}</p>
            <p>Location: ${doctor.location}</p>
            <p>Experience: ${doctor.experience} years</p>
        </div>
    `).join('');
}

function renderHospitals(locationFilter = '') {
    const list = document.getElementById('hospitalsList');
    const filteredHospitals = locationFilter 
        ? hospitals.filter(h => h.location === locationFilter)
        : hospitals;

    list.innerHTML = filteredHospitals.map(hospital => `
        <div class="list-item">
            <div class="list-item-header">
                <h3 class="list-item-title">${hospital.name}</h3>
                <div class="list-item-actions">
                    <button class="delete-btn" onclick="deleteHospital('${hospital.id}')">Delete</button>
                </div>
            </div>
            <p>Location: ${hospital.location}</p>
            <p>Type: ${hospital.type}</p>
            <p>Facilities: ${hospital.facilities.join(', ')}</p>
        </div>
    `).join('');
}

function renderPatients() {
    const list = document.getElementById('patientsList');
    list.innerHTML = patients.map(patient => `
        <div class="list-item">
            <div class="list-item-header">
                <h3 class="list-item-title">${patient.name}</h3>
                <div class="list-item-actions">
                    <button class="delete-btn" onclick="deletePatient('${patient.id}')">Delete</button>
                </div>
            </div>
            <p>Age: ${patient.age}</p>
            <p>Contact: ${patient.contact}</p>
            <p>Medical History:</p>
            <ul>
                ${patient.medicalHistory.map(item => `<li>${item}</li>`).join('')}
            </ul>
        </div>
    `).join('');
}

// Delete Functions
function deleteDoctor(id) {
    doctors = doctors.filter(d => d.id !== id);
    renderDoctors();
}

function deleteHospital(id) {
    hospitals = hospitals.filter(h => h.id !== id);
    renderHospitals();
}

function deletePatient(id) {
    patients = patients.filter(p => p.id !== id);
    renderPatients();
}

// Initial Render
renderDoctors();
renderHospitals();
renderPatients();