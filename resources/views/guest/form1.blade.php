<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Symptom Predictor - HealthConnect</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card {
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 20px 25px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        input,
        select,
        textarea {
            font-family: inherit;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .pulse-in {
            animation: pulseIn 0.4s ease-out;
        }

        @keyframes pulseIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</head>

<body class="bg-gray-50">

    <!-- Header Section -->
    <div class="gradient-bg text-white py-12 md:py-20 relative z-10">
        <div class="max-w-6xl mx-auto px-4">
            <div class="fade-in">
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-heartbeat text-white text-3xl"></i>
                    <h1 class="text-4xl md:text-5xl font-bold text-white">
                        Symptom Predictor
                    </h1>
                </div>
                <p class="text-xl text-blue-100 mb-2">Get specialist recommendations instantly</p>
                <p class="text-blue-100 opacity-90">Our AI-powered system analyzes your symptoms to connect you
                    with the right healthcare specialist</p>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Form Section -->
            <div class="lg:col-span-1">
                <div class="card bg-white p-8 sticky top-8">
                    <div class="flex items-center gap-2 mb-2">
                        <i class="fas fa-pen-to-square text-blue-600 text-xl"></i>
                        <h2 class="text-2xl font-bold text-gray-900">Your Information</h2>
                    </div>
                    <p class="text-gray-500 text-sm mb-8">Complete the form for accurate prediction</p>

                    <form id="healthForm" class="space-y-6">
                        @csrf

                        <!-- Symptoms Section -->
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-3 flex items-center gap-2">
                                <i class="fas fa-stethoscope text-red-500"></i>
                                <span>Your Symptoms <span class="text-red-500">*</span></span>
                            </label>
                            <div class="relative">
                                <input type="text" id="symptom-input" placeholder="Start typing a symptom..."
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">

                                <!-- Suggestions -->
                                <div id="suggestions"
                                    class="absolute top-full left-0 right-0 mt-2 bg-white border-2 border-gray-200 rounded-xl z-50 max-h-60 overflow-y-auto hidden shadow-xl">
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">
                                <i class="fas fa-info-circle mr-1"></i>Select all symptoms you're experiencing
                            </p>
                        </div>

                        <!-- Selected symptoms -->
                        <div>
                            <div id="selected" class="flex flex-wrap gap-2 min-h-10">
                                <p class="text-gray-400 text-sm italic">No symptoms selected yet</p>
                            </div>
                        </div>

                        <!-- Age input -->
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-3 flex items-center gap-2">
                                <i class="fas fa-birthday-cake text-blue-500"></i>
                                <span>Age <span class="text-red-500">*</span></span>
                            </label>
                            <input type="number" name="age" id="age" placeholder="Enter your age"
                                min="1" max="150" required
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                        </div>

                        <!-- Gender select -->
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-3 flex items-center gap-2">
                                <i class="fas fa-venus-mars text-purple-500"></i>
                                <span>Gender <span class="text-red-500">*</span></span>
                            </label>
                            <select name="gender" id="gender"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                                <option value="">Select your gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                {{-- <option value="Other">Other</option> --}}
                            </select>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" id="submitBtn"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold py-3 rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all hover:shadow-lg flex items-center justify-center gap-2">
                            <span id="btnText">
                                <i class="fas fa-flask-vial mr-2"></i>Get Recommendation
                            </span>
                            <span id="btnLoading" class="hidden">
                                <i class="fas fa-spinner fa-spin mr-2"></i>Analyzing...
                            </span>
                        </button>

                        <!-- Error message -->
                        <div id="errorMsg"
                            class="hidden bg-red-50 border-l-4 border-red-500 p-4 rounded text-red-700 text-sm flex items-start gap-3">
                            <i class="fas fa-exclamation-circle flex-shrink-0 mt-0.5"></i>
                            <p id="errorText"></p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Results Section -->
            <div class="lg:col-span-2">
                <div id="resultContainer" class="hidden">
                    <!-- Loading State -->
                    <div id="loadingState" class="bg-white rounded-2xl card p-12 hidden text-center">
                        <div class="inline-block">
                            <i class="fas fa-circle-notch fa-spin text-blue-600 text-5xl mb-4 block"></i>
                            <p class="text-gray-600 font-semibold text-lg">Analyzing your symptoms...</p>
                        </div>
                    </div>

                    <!-- Result Card -->
                    <div id="resultCard" class="hidden fade-in">
                        <!-- Main Result -->
                        <div class="bg-white rounded-2xl card p-8 md:p-10 mb-6 border-t-4 border-green-500">
                            <div class="text-center mb-10">
                                <div
                                    class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-6 pulse-in">
                                    <i class="fas fa-check text-green-600 text-4xl"></i>
                                </div>
                                <h3 class="text-gray-600 font-semibold text-lg mb-3">Recommended Specialist</h3>
                                <h2 id="specialistName"
                                    class="text-5xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-4">
                                </h2>
                                <p class="text-gray-600">
                                    Based on your symptoms, age, and gender
                                </p>
                            </div>

                            <!-- Your Info Summary -->
                            <div
                                class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-6 border border-blue-100 mb-8">
                                <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                                    <i class="fas fa-list-check text-blue-600"></i>
                                    Your Information
                                </h4>
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="text-center">
                                        <p class="text-gray-500 text-sm mb-1">Age</p>
                                        <p id="summaryAge" class="text-3xl font-bold text-gray-800"></p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-gray-500 text-sm mb-1">Gender</p>
                                        <p id="summaryGender" class="text-3xl font-bold text-gray-800"></p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-gray-500 text-sm mb-1">Symptoms</p>
                                        <p id="summarySymptomCount" class="text-3xl font-bold text-gray-800"></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Symptoms List -->
                            <div class="mb-8">
                                <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                                    <i class="fas fa-stethoscope text-red-500"></i>
                                    Reported Symptoms
                                </h4>
                                <div id="summarySymptoms" class="flex flex-wrap gap-2"></div>
                            </div>

                            <!-- Info Box -->
                            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg mb-8">
                                <p class="text-gray-700 text-sm">
                                    <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                                    This is an informational recommendation based on your reported symptoms.
                                    <span class="font-semibold">Please consult with a healthcare professional for a
                                        proper diagnosis.</span>
                                </p>
                            </div>

                            <!-- Action Button -->
                            <div class="text-center">
                                <button onclick="resetForm()"
                                    class="bg-gradient-to-r from-gray-600 to-gray-700 text-white font-bold py-3 px-6 rounded-lg hover:from-gray-700 hover:to-gray-800 transition-all inline-flex items-center gap-2">
                                    <i class="fas fa-redo"></i>
                                    Start New Prediction
                                </button>
                            </div>
                        </div>

                        <!-- Matching Specialists Section -->
                        <div class="bg-white rounded-2xl card p-8 md:p-10 mb-6">
                            <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                                <i class="fas fa-user-md text-blue-600"></i>
                                Available Specialists
                            </h3>

                            <div id="matchingSpecialists" class="grid grid-cols-1 gap-6">
                                <!-- Specialists will be populated here by JavaScript -->
                            </div>

                            <div id="noSpecialists" class="hidden text-center py-8">
                                <p class="text-gray-600">No matching specialists available at this time.</p>
                            </div>
                        </div>

                        <!-- Additional Info -->
                        <div class="bg-white rounded-2xl card p-8 md:p-10">
                            <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                                <i class="fas fa-lightbulb text-yellow-500"></i>
                                What You Should Know
                            </h3>
                            <div class="space-y-6">
                                <div class="flex gap-4">
                                    <div
                                        class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-clipboard-check text-blue-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-800 mb-2">What does this mean?</h4>
                                        <p class="text-gray-600 text-sm">
                                            The specialist recommendation is based on your symptoms. Different
                                            specialists have expertise in different areas and can provide targeted care
                                            for your specific condition.
                                        </p>
                                    </div>
                                </div>

                                <div class="flex gap-4">
                                    <div
                                        class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-steps text-green-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-800 mb-2">Next Steps</h4>
                                        <ol class="text-gray-600 text-sm space-y-2 list-decimal list-inside">
                                            <li>Schedule an appointment with the recommended specialist</li>
                                            <li>Prepare a detailed list of your symptoms and when they started</li>
                                            <li>Bring any relevant medical records or test results</li>
                                            <li>Be prepared to discuss your complete medical history</li>
                                        </ol>
                                    </div>
                                </div>

                                <div class="flex gap-4">
                                    <div
                                        class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-triangle-exclamation text-red-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-800 mb-2">Emergency Notice</h4>
                                        <p class="text-gray-600 text-sm">
                                            If you're experiencing severe symptoms such as chest pain, difficulty
                                            breathing, loss of consciousness, severe bleeding, or signs of stroke,
                                            <span class="font-bold">seek emergency medical care immediately.</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div id="emptyState" class="bg-white rounded-2xl card p-12 text-center">
                    <div class="mb-6">
                        <i class="fas fa-stethoscope text-6xl text-gray-300 mb-4 block"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">No Results Yet</h3>
                    <p class="text-gray-600 mb-2">Fill in the form to get your personalized specialist recommendation
                    </p>
                    <p class="text-gray-400 text-sm">This is an AI-powered symptom analyzer to help guide you to the
                        right specialist</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedSymptoms = [];

        const input = document.getElementById('symptom-input');
        const suggestionsBox = document.getElementById('suggestions');
        const selectedBox = document.getElementById('selected');
        const form = document.getElementById('healthForm');
        const submitBtn = document.getElementById('submitBtn');
        const resultContainer = document.getElementById('resultContainer');
        const emptyState = document.getElementById('emptyState');
        const errorMsg = document.getElementById('errorMsg');
        const errorText = document.getElementById('errorText');

        // Symptom autocomplete
        input.addEventListener('keyup', async function() {
            let query = input.value.toLowerCase().trim();

            if (query.length === 0) {
                suggestionsBox.innerHTML = '';
                suggestionsBox.classList.add('hidden');
                return;
            }

            try {
                let res = await fetch('http://127.0.0.1:5173/symptoms');
                let data = await res.json();

                let filtered = data.symptoms.filter(s =>
                    s.toLowerCase().includes(query) && !selectedSymptoms.includes(s)
                );

                suggestionsBox.innerHTML = '';

                if (filtered.length === 0) {
                    suggestionsBox.classList.add('hidden');
                    return;
                }

                suggestionsBox.classList.remove('hidden');

                filtered.slice(0, 5).forEach(symptom => {
                    let div = document.createElement('div');
                    div.innerText = symptom;
                    div.className =
                        "cursor-pointer px-4 py-3 hover:bg-blue-50 border-b border-gray-200 transition font-medium text-gray-700";

                    div.onclick = () => {
                        selectedSymptoms.push(symptom);
                        renderSelected();
                        input.value = '';
                        suggestionsBox.innerHTML = '';
                        suggestionsBox.classList.add('hidden');
                    };

                    suggestionsBox.appendChild(div);
                });
            } catch (err) {
                console.error('Error fetching symptoms:', err);
            }
        });

        // Hide suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('#symptom-input') && !e.target.closest('#suggestions')) {
                suggestionsBox.classList.add('hidden');
            }
        });

        function renderSelected() {
            selectedBox.innerHTML = '';

            if (selectedSymptoms.length === 0) {
                selectedBox.innerHTML = '<p class="text-gray-400 text-sm italic">No symptoms selected yet</p>';
                return;
            }

            selectedSymptoms.forEach((s, index) => {
                let span = document.createElement('span');
                span.className =
                    "bg-gradient-to-r from-blue-100 to-purple-100 border border-blue-300 text-blue-700 px-3 py-2 rounded-full flex items-center gap-2 text-sm font-medium";
                span.innerHTML =
                    `<i class="fas fa-check-circle"></i> ${s} <button type="button" class="font-bold hover:text-blue-900 transition ml-1" onclick="removeSymptom(${index})">&times;</button>`;
                selectedBox.appendChild(span);
            });
        }

        function removeSymptom(index) {
            selectedSymptoms.splice(index, 1);
            renderSelected();
        }

        // Form submission
        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Validation
            if (selectedSymptoms.length === 0) {
                showError('Please select at least one symptom');
                return;
            }

            const age = document.getElementById('age').value;
            const gender = document.getElementById('gender').value;

            if (!age || age < 1 || age > 150) {
                showError('Please enter a valid age between 1 and 150');
                return;
            }

            if (!gender) {
                showError('Please select a gender');
                return;
            }

            // Clear error and show loading
            hideError();
            showLoading();

            try {
                const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
                if (!csrfTokenElement) {
                    showError('CSRF token not found. Please refresh the page.');
                    hideLoading();
                    return;
                }

                const csrfToken = csrfTokenElement.getAttribute('content');

                const response = await fetch('/predict', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    credentials: 'include',
                    body: JSON.stringify({
                        symptoms: selectedSymptoms,
                        age: parseInt(age),
                        gender: gender
                    })
                });

                if (!response.ok) {
                    if (response.status === 419) {
                        showError('Session expired. Please refresh the page and try again.');
                    } else {
                        const data = await response.json().catch(() => ({}));
                        throw new Error(data.message || `Error: ${response.status} ${response.statusText}`);
                    }
                    hideLoading();
                    return;
                }

                const data = await response.json();
                displayResult(data, age, gender);
            } catch (err) {
                hideLoading();
                showError(err.message || 'Error getting prediction. Please try again.');
                console.error('Prediction error:', err);
            }
        });

        function showLoading() {
            resultContainer.classList.remove('hidden');
            emptyState.classList.add('hidden');
            document.getElementById('loadingState').classList.remove('hidden');
            document.getElementById('resultCard').classList.add('hidden');
            document.getElementById('btnText').classList.add('hidden');
            document.getElementById('btnLoading').classList.remove('hidden');
            submitBtn.disabled = true;
        }

        function hideLoading() {
            document.getElementById('loadingState').classList.add('hidden');
            document.getElementById('btnText').classList.remove('hidden');
            document.getElementById('btnLoading').classList.add('hidden');
            submitBtn.disabled = false;
        }

        function displayResult(data, age, gender) {
            hideLoading();

            const specialist = data.top_specialist || 'General Physician';
            const matchingSpecialists = data.matching_specialists || [];

            document.getElementById('specialistName').textContent = specialist;
            document.getElementById('summaryAge').textContent = age;
            document.getElementById('summaryGender').textContent = gender;
            document.getElementById('summarySymptomCount').textContent = selectedSymptoms.length;

            // Display symptoms
            const symptomDiv = document.getElementById('summarySymptoms');
            symptomDiv.innerHTML = '';
            selectedSymptoms.forEach(symptom => {
                let tag = document.createElement('span');
                tag.className =
                    'bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 px-4 py-2 rounded-full text-sm font-medium border border-blue-200';
                tag.innerHTML = `<i class="fas fa-check-circle mr-1"></i>${symptom}`;
                symptomDiv.appendChild(tag);
            });

            // Display matching specialists
            const specialistsContainer = document.getElementById('matchingSpecialists');
            const noSpecialists = document.getElementById('noSpecialists');

            if (matchingSpecialists.length === 0) {
                specialistsContainer.innerHTML = '';
                noSpecialists.classList.remove('hidden');
            } else {
                noSpecialists.classList.add('hidden');
                specialistsContainer.innerHTML = matchingSpecialists.map(doc => `
                    <div class="border border-gray-200 rounded-xl p-6 hover:shadow-lg transition">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h4 class="text-lg font-bold text-gray-900">${doc.name}</h4>
                                <p class="text-blue-600 font-semibold text-sm">${doc.qualification}</p>
                                <p class="text-purple-600 font-medium text-sm">${doc.specialist}</p>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-blue-600">₨${doc.consultation_fee}</div>
                                <p class="text-gray-500 text-xs">Consultation Fee</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div class="bg-blue-50 rounded-lg p-3">
                                <p class="text-gray-600 text-xs mb-1">Experience</p>
                                <p class="font-bold text-gray-900">${doc.experience_years} years</p>
                            </div>
                            <div class="bg-green-50 rounded-lg p-3">
                                <p class="text-gray-600 text-xs mb-1">Clinic</p>
                                <p class="font-bold text-gray-900 truncate">${doc.clinic_address}</p>
                            </div>
                        </div>

                        <p class="text-gray-600 text-sm mb-4">${doc.bio || 'Experienced specialist'}</p>

                        <div class="flex gap-2">
                            <a href="{{ route('login') }}" class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold py-2 px-4 rounded-lg hover:from-blue-700 hover:to-blue-800 transition text-center text-sm">
                                <i class="fas fa-calendar mr-2"></i>Book Appointment
                            </a>
                            <button type="button" onclick="viewDetails(${doc.id})" class="flex-1 border-2 border-gray-300 text-gray-700 font-bold py-2 px-4 rounded-lg hover:bg-gray-50 transition text-sm">
                                <i class="fas fa-info-circle mr-2"></i>Details
                            </button>
                        </div>
                    </div>
                `).join('');
            }

            // Show result card
            document.getElementById('resultCard').classList.remove('hidden');
            resultContainer.classList.remove('hidden');
            emptyState.classList.add('hidden');

            // Scroll to results
            setTimeout(() => {
                document.getElementById('resultCard').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }, 100);
        }

        function viewDetails(doctorId) {
            // Placeholder for viewing doctor details
            alert('Doctor ID: ' + doctorId);
        }

        function showError(message) {
            errorText.textContent = message;
            errorMsg.classList.remove('hidden');
        }

        function hideError() {
            errorMsg.classList.add('hidden');
        }

        function resetForm() {
            form.reset();
            selectedSymptoms = [];
            renderSelected();
            resultContainer.classList.add('hidden');
            emptyState.classList.remove('hidden');
            hideError();
            input.focus();
        }
    </script>

</body>

</html>
