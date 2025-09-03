@extends('layouts.app')

@section('title', 'Create Your Custom Package - Soba Lanka')

@section('content')
<div class="min-h-screen bg-black py-20">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-light text-white mb-4">Create Your Custom Package</h1>
            <p class="text-xl text-gray-300">Design the perfect getaway tailored just for you</p>
        </div>

        <!-- Step 1: Guest Count -->
        <div class="max-w-2xl mx-auto bg-gray-900 rounded-xl p-8 mb-8" id="step1">
            <h2 class="text-2xl text-white mb-6 text-center">How many guests will be joining you?</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-white text-lg mb-2">Adults</label>
                    <input 
                        type="number" 
                        id="adults" 
                        min="1" 
                        max="50" 
                        value="2" 
                        class="w-full p-4 rounded-lg bg-gray-800 text-white border border-gray-700 focus:border-green-500 focus:outline-none text-xl text-center"
                    >
                </div>
                <div>
                    <label class="block text-white text-lg mb-2">Kids (3-11 years)</label>
                    <input 
                        type="number" 
                        id="children" 
                        min="0" 
                        max="20" 
                        value="0" 
                        class="w-full p-4 rounded-lg bg-gray-800 text-white border border-gray-700 focus:border-green-500 focus:outline-none text-xl text-center"
                    >
                </div>
            </div>
            
            <div class="text-center mt-8">
                <button 
                    id="findPackages" 
                    class="bg-green-500 text-white px-8 py-4 rounded-lg text-xl hover:bg-green-600 transition-all duration-300"
                >
                    Find My Perfect Packages
                </button>
            </div>
        </div>

        <!-- Step 2: Package Selection -->
        <div id="step2" class="hidden">
            <div class="text-center mb-8">
                <h2 class="text-3xl text-white mb-2" id="categoryTitle"></h2>
                <p class="text-gray-300" id="guestSummary"></p>
            </div>

            <!-- Package Types -->
            <div id="packageTypes" class="space-y-8">
                <!-- Day Out Packages -->
                <div class="package-type-section" data-type="day_out">
                    <h3 class="text-2xl text-green-400 mb-6 text-center">Day Out Packages</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="dayOutPackages">
                        <!-- Packages will be loaded here -->
                    </div>
                </div>

                <!-- Half Board Packages -->
                <div class="package-type-section" data-type="half_board">
                    <h3 class="text-2xl text-green-400 mb-6 text-center">Half Board Packages</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="halfBoardPackages">
                        <!-- Packages will be loaded here -->
                    </div>
                </div>

                <!-- Full Board Packages -->
                <div class="package-type-section" data-type="full_board">
                    <h3 class="text-2xl text-green-400 mb-6 text-center">Full Board Packages</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="fullBoardPackages">
                        <!-- Packages will be loaded here -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 3: Package Details & Booking -->
        <div id="step3" class="hidden">
            <div class="max-w-4xl mx-auto bg-gray-900 rounded-xl p-8">
                <h2 class="text-3xl text-white mb-6 text-center">Package Details</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Package Info -->
                    <div>
                        <div id="selectedPackageImages" class="mb-6">
                            <!-- Images will be loaded here -->
                        </div>
                        
                        <h3 class="text-2xl text-green-400 mb-4" id="selectedPackageName"></h3>
                        
                        <div class="mb-6">
                            <h4 class="text-lg text-white mb-2">Description</h4>
                            <div class="text-gray-300" id="selectedPackageDescription"></div>
                        </div>
                        
                        <div class="mb-6">
                            <h4 class="text-lg text-white mb-2">Menu</h4>
                            <div class="text-gray-300" id="selectedPackageMenu"></div>
                        </div>
                    </div>
                    
                    <!-- Price Breakdown -->
                    <div class="bg-gray-800 rounded-lg p-6">
                        <h4 class="text-xl text-white mb-4">Price Breakdown</h4>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-gray-300" id="adultPriceRow">
                                <span>Adults (<span id="adultCount">0</span> × <span id="adultPrice">Rs 0</span>)</span>
                                <span id="adultSubtotal">Rs 0</span>
                            </div>
                            <div class="flex justify-between text-gray-300" id="childPriceRow">
                                <span>Children (<span id="childCount">0</span> × <span id="childPrice">Rs 0</span>)</span>
                                <span id="childSubtotal">Rs 0</span>
                            </div>
                            <hr class="border-gray-700">
                            <div class="flex justify-between text-xl text-green-400 font-bold">
                                <span>Total</span>
                                <span id="totalPrice">Rs 0</span>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <button 
                                class="w-full bg-green-500 text-white py-3 rounded-lg text-lg hover:bg-green-600 transition-all duration-300"
                                onclick="proceedToBooking()"
                            >
                                Proceed to Booking
                            </button>
                            
                            <button 
                                class="w-full bg-gray-700 text-white py-3 rounded-lg text-lg hover:bg-gray-600 transition-all duration-300"
                                onclick="goBack()"
                            >
                                Choose Different Package
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let selectedPackage = null;
let currentAdults = 2;
let currentChildren = 0;

document.addEventListener('DOMContentLoaded', function() {
    // Handle input changes
    document.getElementById('adults').addEventListener('input', updateGuestCount);
    document.getElementById('children').addEventListener('input', updateGuestCount);
    
    // Handle find packages button
    document.getElementById('findPackages').addEventListener('click', findPackages);
});

function updateGuestCount() {
    currentAdults = parseInt(document.getElementById('adults').value) || 1;
    currentChildren = parseInt(document.getElementById('children').value) || 0;
}

function findPackages() {
    updateGuestCount();
    
    if (currentAdults < 1) {
        alert('Please enter at least 1 adult.');
        return;
    }
    
    // Show loading state
    document.getElementById('findPackages').textContent = 'Loading...';
    document.getElementById('findPackages').disabled = true;
    
    // Fetch packages
    fetch('/package-builder/get-packages', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            adults: currentAdults,
            children: currentChildren
        })
    })
    .then(response => response.json())
    .then(data => {
        displayPackages(data);
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').classList.remove('hidden');
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error loading packages. Please try again.');
    })
    .finally(() => {
        document.getElementById('findPackages').textContent = 'Find My Perfect Packages';
        document.getElementById('findPackages').disabled = false;
    });
}

function displayPackages(data) {
    const categoryTitles = {
        'couple': 'Couple Packages',
        'family': 'Family Packages', 
        'group': 'Group Packages'
    };
    
    document.getElementById('categoryTitle').textContent = categoryTitles[data.category];
    document.getElementById('guestSummary').textContent = `${data.adults} Adult${data.adults > 1 ? 's' : ''}${data.children > 0 ? ` and ${data.children} Child${data.children > 1 ? 'ren' : ''}` : ''}`;
    
    // Clear previous packages
    document.getElementById('dayOutPackages').innerHTML = '';
    document.getElementById('halfBoardPackages').innerHTML = '';
    document.getElementById('fullBoardPackages').innerHTML = '';
    
    // Display packages by type
    Object.keys(data.packages).forEach(type => {
        const containerId = type === 'day_out' ? 'dayOutPackages' : 
                           type === 'half_board' ? 'halfBoardPackages' : 
                           'fullBoardPackages';
        
        const container = document.getElementById(containerId);
        
        Object.keys(data.packages[type]).forEach(subType => {
            data.packages[type][subType].forEach(package => {
                const packageCard = createPackageCard(package, data.adults, data.children);
                container.appendChild(packageCard);
            });
        });
        
        // Hide section if no packages
        if (container.children.length === 0) {
            container.parentElement.style.display = 'none';
        }
    });
}

function createPackageCard(package, adults, children) {
    const total = (package.adult_price * adults) + (package.child_price * children);
    const isAvailable = package.available;
    
    const card = document.createElement('div');
    card.className = `bg-gray-800 rounded-lg p-6 ${isAvailable ? 'hover:bg-gray-700 cursor-pointer' : 'opacity-50'} transition-all duration-300`;
    
    card.innerHTML = `
        <div class="mb-4">
            ${package.images && package.images.length > 0 ? 
                `<img src="/storage/${package.images[0]}" alt="${package.name}" class="w-full h-48 object-cover rounded-lg mb-4">` : 
                '<div class="w-full h-48 bg-gray-700 rounded-lg mb-4 flex items-center justify-center"><span class="text-gray-500">No Image</span></div>'
            }
            <h4 class="text-xl text-white font-bold mb-2">${package.name}</h4>
            ${package.description ? `<p class="text-gray-300 text-sm mb-3">${package.description.substring(0, 100)}...</p>` : ''}
        </div>
        
        <div class="mb-4">
            <div class="text-green-400 text-2xl font-bold">Rs ${total.toLocaleString()}</div>
            <div class="text-gray-400 text-sm">
                Adults: Rs ${package.adult_price} × ${adults} = Rs ${(package.adult_price * adults).toLocaleString()}<br>
                ${children > 0 ? `Children: Rs ${package.child_price} × ${children} = Rs ${(package.child_price * children).toLocaleString()}` : ''}
            </div>
        </div>
        
        ${!isAvailable ? 
            '<div class="text-red-400 text-sm mb-2">Requires minimum ' + package.min_adults + ' adults</div>' : 
            ''
        }
        
        <button 
            class="w-full ${isAvailable ? 'bg-green-500 hover:bg-green-600' : 'bg-gray-600'} text-white py-2 rounded-lg transition-all duration-300"
            ${isAvailable ? `onclick="selectPackage(${package.id})"` : 'disabled'}
        >
            ${isAvailable ? 'Select This Package' : 'Not Available'}
        </button>
    `;
    
    return card;
}

function selectPackage(packageId) {
    // Show loading
    const button = event.target;
    button.textContent = 'Loading...';
    button.disabled = true;
    
    fetch('/package-builder/calculate-price', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            package_id: packageId,
            adults: currentAdults,
            children: currentChildren
        })
    })
    .then(response => response.json())
    .then(data => {
        selectedPackage = data;
        displayPackageDetails(data);
        document.getElementById('step2').classList.add('hidden');
        document.getElementById('step3').classList.remove('hidden');
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error loading package details. Please try again.');
    })
    .finally(() => {
        button.textContent = 'Select This Package';
        button.disabled = false;
    });
}

function displayPackageDetails(data) {
    document.getElementById('selectedPackageName').textContent = data.package.name;
    document.getElementById('selectedPackageDescription').textContent = data.package.description || 'No description available';
    document.getElementById('selectedPackageMenu').textContent = data.package.menu || 'Menu details not available';
    
    // Display images
    const imagesContainer = document.getElementById('selectedPackageImages');
    imagesContainer.innerHTML = '';
    
    if (data.package.images && data.package.images.length > 0) {
        data.package.images.forEach((image, index) => {
            const img = document.createElement('img');
            img.src = `/storage/${image}`;
            img.alt = data.package.name;
            img.className = 'w-full h-48 object-cover rounded-lg mb-2';
            imagesContainer.appendChild(img);
        });
    } else {
        imagesContainer.innerHTML = '<div class="w-full h-48 bg-gray-700 rounded-lg mb-4 flex items-center justify-center"><span class="text-gray-500">No Images Available</span></div>';
    }
    
    // Update price breakdown
    document.getElementById('adultCount').textContent = data.adults;
    document.getElementById('adultPrice').textContent = `Rs ${data.adult_price.toLocaleString()}`;
    document.getElementById('adultSubtotal').textContent = `Rs ${data.subtotal_adults.toLocaleString()}`;
    
    document.getElementById('childCount').textContent = data.children;
    document.getElementById('childPrice').textContent = `Rs ${data.child_price.toLocaleString()}`;
    document.getElementById('childSubtotal').textContent = `Rs ${data.subtotal_children.toLocaleString()}`;
    
    document.getElementById('totalPrice').textContent = `Rs ${data.total.toLocaleString()}`;
    
    // Hide children row if no children
    document.getElementById('childPriceRow').style.display = data.children > 0 ? 'flex' : 'none';
}

function goBack() {
    document.getElementById('step3').classList.add('hidden');
    document.getElementById('step2').classList.remove('hidden');
}

function proceedToBooking() {
    // Here you can redirect to booking page or open booking form
    // For now, we'll show an alert
    alert('Booking functionality would be implemented here. Package: ' + selectedPackage.package.name + ', Total: Rs ' + selectedPackage.total.toLocaleString());
}
</script>

@push('styles')
<style>
body {
    background-color: #000000;
}

.package-type-section:empty {
    display: none;
}
</style>
@endpush
@endsection