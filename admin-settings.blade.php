<form action="{{ route('admin.settings.store') }}" method="POST">
    @csrf

    <!-- Card Header -->
    <div class="card-header">
        <h4>Theme Settings</h4>
    </div>

    <!-- Card Body -->
    <div class="card-body">
        <div class="row">

            <!-- Theme Presets Section -->
            <div class="form-group col-12">
                <h5 class="form-label d-flex justify-content-center">Default Theme Layout</h5>
                <div class="row gutters-sm mt-4">
                    @foreach($theme->theme_presets as $key => $themePreset)
                        <div class="col-6 col-sm-3">
                            <label class="imagecheck mb-4">
                                <h6 class="text-dark">{{ $themePreset['name'] }}</h6>
                                <input name="theme::default::theme-preset" type="radio" value="{{ $key }}"
                                       onchange="updateThemeColors('{{ $themePreset['colors'] }}')"
                                       class="imagecheck-input"
                                       @if(settings('theme::default::theme') == $themePreset['colors']) checked @endif>
                                <figure class="imagecheck-figure">
                                    <img src="{{ $themePreset['image'] }}?v{{ $theme->version }}"
                                         alt="{{ $themePreset['name'] }}" class="imagecheck-image theme-image">
                                </figure>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Theme Customization Section -->
            <div class="form-group col-12">
                <h5 class="d-flex justify-content-center">Theme Customization</h5>
                <div id="themeEditor" class="row justify-content-center mt-4">
                    @php
                        $themeColorsJson = settings('theme::default::theme', '{"50": "#F9FAFB","100": "#F3F4F6","200": "#E5E7EB","300": "#D1D5DB","400": "#9CA3AF","500": "#6B7280","600": "#4c4f6d","700": "#2f3247","800": "#252839","900": "#1f2133"}');
                        $themeColors = json_decode($themeColorsJson, true);
                    @endphp
                    @foreach($themeColors as $key => $color)
                        <div class="col-2 mb-3">
                            <label class="form-label">Shade {{ $key }}</label>
                            <div class="input-group">
                                <input type="color" class="form-control form-control-color" value="{{ $color }}"
                                       onchange="updateThemeColor('{{ $key }}', this.value)">
                                <input type="text" class="form-control text-center" id="color-{{ $key }}" value="{{ $color }}"
                                       onchange="updateThemeColor('{{ $key }}', this.value)">
                            </div>
                        </div>
                    @endforeach
                </div>
                <textarea name="theme::default::theme" id="theme_colors" class="form-control">@json($themeColors)</textarea>
            </div>

            <!-- Default Theme Color Section -->
            <div class="form-group col-md-12">
                <label for="theme_color">Default Theme Color</label>
                <select class="form-control" name="theme::default::theme-color" id="theme_color">
                    @foreach ($theme->tailwind_colors as $color)
                        <option value="{{ $color }}" @if (settings('theme::default::theme-color', 'indigo') == $color) selected @endif>
                            {{ ucfirst($color) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Navigation Selection Section -->
            <div class="form-group col-12">
                <h5 class="form-label d-flex justify-content-center">Navigation Layout</h5>
                <div class="row gutters-sm justify-content-center mt-4">
                    @foreach($theme->navigation as $key => $nav)
                        <div class="col-6 col-sm-3">
                            <label class="imagecheck mb-4">
                                <h6 class="text-dark">{{ $nav['name'] }}</h6>
                                <input name="theme::default::navigation" type="radio" value="{{ $key }}"
                                       class="imagecheck-input"
                                       @if(settings('theme::default::navigation', 'navbar') == $key) checked @endif>
                                <figure class="imagecheck-figure">
                                    <img src="{{ $nav['image'] }}" alt="{{ $nav['name'] }}" class="imagecheck-image">
                                </figure>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Category Structure Section -->
            <div class="form-group col-12">
                <h5 class="form-label d-flex justify-content-center">Category Structure</h5>
                <div class="row gutters-sm justify-content-center mt-4">
                    @foreach($theme->category_structures as $key => $structure)
                        <div class="col-6 col-sm-3">
                            <label class="imagecheck mb-4">
                                <h6 class="text-dark">{{ $structure['name'] }}</h6>
                                <input name="theme::default::categories_structure" type="radio" value="{{ $key }}"
                                       class="imagecheck-input"
                                       @if(settings('theme::default::categories_structure', 'grid') == $key) checked @endif>
                                <figure class="imagecheck-figure">
                                    <img src="{{ $structure['image'] }}" alt="{{ $structure['name'] }}" class="imagecheck-image">
                                </figure>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Social Media Settings Section -->
            @foreach ($theme->socials as $social)
                <div class="form-group col-4">
                    <label>{{ ucfirst($social) }}</label>
                    <input type="text" name="socials::{{ $social }}" value="@settings('socials::' . $social, '')" class="form-control">
                </div>
            @endforeach

            <!-- Authentication Page Customization Section -->
            <div class="form-group col-12">
                <label>Authentication Page Title</label>
                <input type="text" name="theme::default::auth::title"
                       value="@settings('theme::default::auth::title', 'Your Game, Our World: Hosting Perfected')" class="form-control">
            </div>
            <div class="form-group col-12">
                <label>Authentication Page Description</label>
                <input type="text" name="theme::default::auth::description"
                       value="@settings('theme::default::auth::description', 'Here you might want to explain how everything works.')"
                       class="form-control">
            </div>
            <div class="form-group col-12">
                <label>Authentication Page Customers</label>
                <input type="text" name="theme::default::auth::customers"
                       value="@settings('theme::default::auth::customers', 'Join over 3.2k members')" class="form-control">
            </div>

            <!-- Theme Mode Settings Section -->
            <div class="form-group col-6">
                <label for="allow_toggle_mode">Allow Toggle Theme Mode</label>
                <select class="form-control" name="theme::allow_toggle_mode" tabindex="-1" aria-hidden="true">
                    <option value="1" @if(settings('theme::allow_toggle_mode', 1) == 1) selected @endif>Yes</option>
                    <option value="0" @if(settings('theme::allow_toggle_mode', 1) == 0) selected @endif>No</option>
                </select>
            </div>
            <div class="form-group col-6">
                <label for="allow_toggle_mode">Default Theme Mode</label>
                <select class="form-control" name="theme::default_mode" tabindex="-1" aria-hidden="true">
                    <option value="dark" @if(settings('theme::default_mode', 'dark') == 'dark') selected @endif>Dark</option>
                    <option value="light" @if(settings('theme::default_mode', 'dark') == 'light') selected @endif>Light</option>
                </select>
            </div>

            <!-- Footer Settings Section -->
            <div class="form-group col-6">
                <div class="mb-3">
                    <label class="form-label" for="footer_enabled">Footer Enabled</label>
                    <select class="form-control" name="footer::enabled" id="footer_enabled">
                        <option value="1" @if(settings('footer::enabled', 1) == 1) selected @endif>Enabled</option>
                        <option value="0" @if(settings('footer::enabled', 1) == 0) selected @endif>Disabled</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-6">
                <label>Footer Type</label>
                <select class="form-control" name="footer::type">
                    @foreach ($theme->footer_types as $key)
                        <option value="{{ $key }}" @if(settings('footer::type', 'default') == $key) selected @endif>
                            {{ ucfirst($key) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Card Footer -->
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>

<!-- JavaScript for Dynamic Theme Updates -->
<script>
    // Function to update a single theme color
    function updateThemeColor(shade, color) {
        let textarea = document.getElementById('theme_colors');
        let colors = JSON.parse(textarea.value);

        // Update color value for the specified shade
        colors[shade] = color;

        // Synchronize the input field for the color value
        document.getElementById('color-' + shade).value = color;
        textarea.value = JSON.stringify(colors);
    }

    // Function to update theme colors from a preset
    function updateThemeColors(colors) {
        document.getElementById('theme_colors').value = colors;
    }

    // Adjust image heights for theme presets after the document is loaded
    document.addEventListener("DOMContentLoaded", function () {
        function adjustImageHeights() {
            let images = document.querySelectorAll('.theme-image');
            let maxHeight = 0;

            // Find the maximum image height
            images.forEach(img => {
                img.style.height = 'auto'; // Reset height before measuring
                let imgHeight = img.clientHeight;
                if (imgHeight > maxHeight) {
                    maxHeight = imgHeight;
                }
            });

            // Apply the maximum height to all images
            images.forEach(img => {
                img.style.height = maxHeight + 'px';
            });
        }

        // Adjust images on page load
        adjustImageHeights();
        window.addEventListener('load', adjustImageHeights);
    });
</script>
