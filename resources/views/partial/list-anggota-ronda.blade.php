@foreach($users as $user)

<div class="form-check py-2 border-bottom user-item">

    <input class="form-check-input user-check" data-id="{{$user->id}}" data-name="{{$user->nama_lengkap}}"
        type="checkbox" name="users[]" value="{{ $user->id }}" id="user{{ $user->id }}">

    <label class="form-check-label w-100" for="user{{ $user->id }}" style="cursor:pointer;">
        {{ $user->nama_lengkap }}
    </label>
</div>
@endforeach