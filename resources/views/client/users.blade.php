<div class='panel form row panel-users-info'>
    <div class='panel-header'>
        <h2>{!!__("profile.userUsers")!!}</h2>

        <button class='btn btn-primary' rule='add' action='save'>  <i class="fa-thin fa-plus"></i> {{ __("form.add") }}</button>

        <div class='search form-group'>
            <i class="fa-solid fa-magnifying-glass"> </i>
            <input type="text" class="form-control" name='search' placeholder='{!! __("profile.search") !!}' required>
        </div>
    </div>
</div>