<form action="{{ route('admin.settings.store') }}" method="POST">
    @csrf
    <div class="card-header">
        <h4>{!! __('admin.theme_settings') !!}</h4>
    </div>

    <div class="card-body">
        <div class="row">

            <!-- Theme Presets -->
            <div class="form-group col-12">
                <h5 class="form-label d-flex justify-content-center">{!! __('Default Theme Layout') !!}</h5>
                <div class="row gutters-sm mt-4">
                    @foreach($theme->config('theme_presets') as $key => $themePreset)
                        <div class="col-6 col-sm-3">
                            <label class="imagecheck mb-4">
                                <h6 class="text-dark">{{ $themePreset['name'] }}</h6>
                                <input name="theme::default::theme-preset" type="radio" value="{{ $key }}"
                                       onchange="updateThemeColors('{{ $themePreset['colors'] }}')"
                                       class="imagecheck-input"
                                       @if(settings('theme::default::theme') == $themePreset['colors']) checked @endif>
                                <figure class="imagecheck-figure">
                                    <img src="{{ $themePreset['image'] }}?v{{ $theme->get('version', '1.0.0') }}"
                                         alt="{{ $themePreset['name'] }}" class="imagecheck-image theme-image">
                                </figure>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Theme Customization -->
            <div class="form-group col-12">
                <h5 class="d-flex justify-content-center">{!! __('admin.theme') !!}</h5>

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
                <textarea name="theme::default::theme" id="theme_colors" class="form-control ">@json($themeColors)</textarea>
            </div>

            <!-- Default Theme Color -->
            <div class="form-group col-md-12">
                <label for="theme_color">{!! __('admin.default_theme_color') !!}</label>
                <select class="form-control select2" name="theme::default::theme-color">
                    @foreach ($theme->config('tailwind-colors') as $color)
                        <option value="{{ $color }}" @if (settings('theme::default::theme-color', 'indigo') == $color) selected @endif>
                            {{ ucfirst($color) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Navigation Selection -->
            <div class="form-group col-12">
                <h5 class="form-label d-flex justify-content-center">{!! __('Navigation Layout') !!}</h5>
                <div class="row gutters-sm justify-content-center mt-4">
                    @foreach($theme->config('navigation') as $key => $nav)
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

            <!-- Category Structure -->
            <div class="form-group col-12">
                <h5 class="form-label d-flex justify-content-center">{!! __('Category Structure') !!}</h5>
                <div class="row gutters-sm justify-content-center mt-4">
                    @foreach($theme->config('category_structures') as $key => $structure)
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

            <!-- Social Media Settings -->
            @foreach ($theme->config('socials') as $social)
                <div class="form-group col-4">
                    <label>{!! __('admin.' . $social) !!}</label>
                    <input type="text" name="socials::{{ $social }}" value="@settings('socials::' . $social, '')" class="form-control">
                </div>
            @endforeach

            <!-- Authentication Page Customization -->
            <div class="form-group col-12">
                <label>{!! __('admin.auth_page_title') !!}</label>
                <input type="text" name="theme::default::auth::title"
                       value="@settings('theme::default::auth::title', 'Your Game, Our World: Hosting Perfected')" class="form-control">
            </div>
            <div class="form-group col-12">
                <label>{!! __('admin.auth_page_description') !!}</label>
                <input type="text" name="theme::default::auth::description"
                       value="@settings('theme::default::auth::description', 'Here you might want to explain how everything works.')"
                       class="form-control">
            </div>
            <div class="form-group col-12">
                <label>{!! __('admin.auth_page_customers') !!}</label>
                <input type="text" name="theme::default::auth::customers"
                       value="@settings('theme::default::auth::customers', 'Join over 3.2k members')" class="form-control">
            </div>

        </div>
    </div>

    <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary">{!! __('admin.submit') !!}</button>
    </div>
</form>

<!-- JavaScript for Dynamic Theme Updates -->
<script>
    function updateThemeColor(shade, color) {
        let textarea = document.getElementById('theme_colors');
        let colors = JSON.parse(textarea.value);

        // Update color value
        colors[shade] = color;

        // Sync input fields
        document.getElementById('color-' + shade).value = color;
        textarea.value = JSON.stringify(colors);
    }
    function updateThemeColors(colors) {
        document.getElementById('theme_colors').value = colors;
    }

    document.addEventListener("DOMContentLoaded", function () {
        function adjustImageHeights() {
            let images = document.querySelectorAll('.theme-image');
            let maxHeight = 0;

            // Find the tallest image
            images.forEach(img => {
                img.style.height = 'auto'; // Reset height before measuring
                let imgHeight = img.clientHeight;
                if (imgHeight > maxHeight) {
                    maxHeight = imgHeight;
                }
            });

            // Apply max height to all images
            images.forEach(img => {
                img.style.height = maxHeight + 'px';
            });
        }

        // Adjust images on page load
        adjustImageHeights();
        window.addEventListener('load', adjustImageHeights);
    });
</script>
