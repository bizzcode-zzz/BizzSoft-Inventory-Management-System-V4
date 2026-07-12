@if ($errors->any())
    <!-- 🎨 DINAGDAGAN NATIN NG DIV TAG SA LABAS PARA MAGKAROON NG PULANG KAHON AT PADDING -->
    <div style="color: #721c24; margin-bottom: 25px; padding: 12px; background-color: #f8d7da; border: 1px solid #f5c6cb; border-radius: 4px; max-width: 350px;">
        
        <!-- ITO PA RIN ANG ORIHINAL NINYONG CODE PARA SA MGA PRODUKTO, WALANG NABAWAS -->
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        
    </div>
@endif
