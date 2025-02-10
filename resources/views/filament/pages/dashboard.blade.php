@if(auth()->user()->hasRole('admin'))
    <x-filament::card>
        <h2>Admin Functions</h2>
        <ul>
            <li><a href="#">View Pending Users</a></li>
            <li><a href="#">Approve User Registration</a></li>
            <li><a href="#">Create Authorized Vehicle</a></li>
            <li><a href="#">Edit Authorized Vehicle</a></li>
        </ul>
    </x-filament::card>
@endif

@if(auth()->user()->hasRole('security_personnel'))
    <x-filament::card>
        <h2>Security Personnel Functions</h2>
        <ul>
            <li><a href="#">View Authorized Vehicles</a></li>
            <li><a href="#">View Unauthorized Vehicles</a></li>
        </ul>
    </x-filament::card>
@endif

@if(auth()->user()->hasRole('vehicle_owner'))
    <x-filament::card>
        <h2>Vehicle Owner Functions</h2>
        <ul>
            <li><a href="#">Register Own Vehicle</a></li>
            <li><a href="#">Edit Own Vehicle</a></li>
        </ul>
    </x-filament::card>
@endif
