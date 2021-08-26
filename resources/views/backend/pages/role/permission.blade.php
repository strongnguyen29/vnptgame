<div class="form-group row mt-3">
    <label for="" class="col-12 col-form-label">Quyền hạn</label>
    <div class="col-sm-12 mt-3 ml-4">
        <ul class="checkbox-tree card-columns">
            @foreach($permissions as $subject => $data)
                @if(!isset($data['actions']))
                    <li class="card shadow-none">

                        <input type="checkbox" name="permissions[]" value="{{ $subject }}"
                            id="input-permission-{{ $subject }}" class="indeterminate-checkbox"
                            {{ isset($rolePermissions) && in_array($subject, $rolePermissions) ? 'checked' : '' }}>

                        <label for="input-permission-{{ $subject }}" class="ml-2 font-weight-normal">{{ $data['label'] }}</label>
                    </li>
                @else
                    <li class="card shadow-none">
                        <input type="checkbox" id="checkbox-{{ $subject }}" class="indeterminate-checkbox">
                        <label for="checkbox-{{ $subject }}">{{ $data['label'] }}</label>
                        <ul>
                            @foreach($data['actions'] as $action)
                                <li>
                                    <input type="checkbox" name="permissions[]" value="{{ $action . ' ' . $subject }}"
                                        id="input-{{ $subject . $action }}" class="indeterminate-checkbox"
                                        {{ isset($rolePermissions) && in_array($action . ' ' . $subject, $rolePermissions) ? 'checked' : '' }}>

                                    <label for="input-{{ $subject . $action }}"> {{ $action }}</label>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
