<form action="{{ route('admin.settings.store') }}" method="POST">
    @csrf
    <div class="card-header">
        <h4>{!! __('admin.theme_settings') !!}</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-12 col-12">
                <label for="user">{!! __('admin.default_theme_color') !!}</label>
                <select class="form-control select2 select2-hidden-accessible" name="theme::default::theme-color" tabindex="-1"
                    aria-hidden="true">
                    @foreach (config('utils.tailwind-colors') as $color)
                        <option value="{{ $color }}" @if (settings('theme::default::theme-color', 'indigo') == $color) selected="" @endif>
                            {{ $color }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-6">
                <label>{!! __('admin.discord') !!}</label>
                <input type="text" name="socials::discord" value="@settings('socials::discord', '')" class="form-control">
            </div>
            <div class="form-group col-6">
                <label>{!! __('admin.github') !!}</label>
                <input type="text" name="socials::github" value="@settings('socials::github', '')" class="form-control">
            </div>
            <div class="form-group col-6">
                <label>{!! __('admin.twitter') !!}</label>
                <input type="text" name="socials::twitter" value="@settings('socials::twitter', '')" class="form-control">
            </div>
            <div class="form-group col-6">
                <label>{!! __('admin.auth_page_title') !!}</label>
                <input type="text" name="theme::default::auth::title"
                    value="@settings('theme::default::auth::title', 'Your Game, Our World: Hosting Perfected')" class="form-control">
            </div>
            <div class="form-group col-6">
                <label>{!! __('admin.auth_page_description') !!}</label>
                <input type="text" name="theme::default::auth::description"
                    value="@settings('theme::default::auth::description', 'Here you might want to explain how everything works. You can edit this in Admin -> configuration -> Theme Settings')"
                    class="form-control">
            </div>
            <div class="form-group col-6">
                <label>{!! __('admin.auth_page_customers') !!}</label>
                <input type="text" name="theme::default::auth::customers"
                    value="@settings('theme::default::auth::customers', 'Join over 3.2k members')" class="form-control">
            </div>
            {{-- <div class="form-group col-12">
                <label class="form-label">Default Theme Layout</label>
                <div class="row gutters-sm">
                    <div class="col-6 col-sm-4">
                        <label class="imagecheck mb-4">
                            <input name="default::layout" type="radio" value="stacked" class="imagecheck-input"
                                @if (Settings::get('default::layout', 'stacked') == 'stacked') checked="" @endif>
                            <figure class="imagecheck-figure">
                                <img src="https://tailwindui.com/img/category-thumbnails/application-ui/stacked.png" alt=""
                                    class="imagecheck-image">
                            </figure>
                        </label>
                    </div>
                    <div class="col-6 col-sm-4">
                        <label class="imagecheck mb-4">
                            <input name="default::layout" type="radio" value="sidebar" class="imagecheck-input"
                                @if (Settings::get('default::layout', 'stacked') == 'sidebar') checked @endif>
                            <figure class="imagecheck-figure">
                                <img src="https://tailwindui.com/img/category-thumbnails/application-ui/sidebar.png" alt=""
                                    class="imagecheck-image">
                            </figure>
                        </label>
                    </div>
                    <div class="col-6 col-sm-4">
                        <label class="imagecheck mb-4">
                            <input name="default::layout" type="radio" value="multi" class="imagecheck-input"
                                @if (Settings::get('default::layout', 'stacked') == 'multi') checked="" @endif>
                            <figure class="imagecheck-figure">
                                <img src="https://tailwindui.com/img/category-thumbnails/application-ui/multi-column.png" alt=""
                                    class="imagecheck-image">
                            </figure>
                        </label>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary">{!! __('admin.submit') !!}</button>
    </div>
</form>
