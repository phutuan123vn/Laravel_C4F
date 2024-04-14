@extends('layouts.app')
@section('content')
{{-- {{ dd(request()->path()) }} --}}
<form class="container mt-4" method="POST" id="formSelect" action="{{ url('/dashboard/delete') }}">
  @csrf
  <input type="hidden" name="_method" value="DELETE" id="visible-form">
  <div class="row">
    <h1 class=".col-md-8 w-75">Dashboard</h1>
    @isset($trash)
    <h1 class=".col-6 text-center w-25 right">
      <a href="/dashboard/trash">
        <span class="bold" style="height: 45px;"> {{ $trash }} </span>
      </a>
    </h1>
    @endisset
  </div>
  <div class="mt-4 d-flex align-items-center">
    <div class="form-check me-5">
      <input class="form-check-input" type="checkbox" id="select-all">
      <label class="form-check-label" for="select-all">Select All</label>
    </div>
    <select id="actionMethod" class="form-select mx-5" style="width: 10em;" aria-label="Default select example" name="action" required>
      <option value="">-- Options --</option>
      <option value="delete"> Delete </option>
      @if (request()->path() === 'dashboard/trash')
        <option value="restore"> Restore </option>
        
      @endif
    </select>
    <button type="submit" id="formSelectBtn" class="btn btn-primary disabled">Confirm</button>

  </div>
  {{-- {{ dd($blogs) }} --}}
  @if (isset($blogs) && count($blogs) > 0)
    <table class="table mt-4">
    <thead>
        <tr>
        <th scope="col" class="text-center">#</th>
        <th scope="col">Name</th>
        <th scope="col" colspan="2">Modified Time</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($blogs as $blog )
        <tr>
        
        <th scope="row">
          <div class="form-check align-items-center">
            <input class="form-check-input border border-2" type="checkbox" id="{{$blog->id}}" value="{{$blog->id}}" name="courseIDs[]">
            <label class="form-check-label ms-2" for="{{$blog->id}}">{{$loop->index + 1}}</label>
          </div>
        </th>
        <td>{{$blog->title}}</td>
        <td>{{$blog->updated_at}}</td>
        <td>
            @if (request()->path() === 'dashboard/trash')
              <a data-id="{{$blog->id}}" class="btn btn-link" id="restore_btn">Restore</a>
            @endif
            <a class="btn btn-link" 
                data-bs-toggle="modal" data-bs-target="#delete-modal"
                data-id="{{$blog->id}}">Delete</a>
        </td>
        </tr>
        @empty
        <td colspan="5" class="text-center">
          <h1 class="text-center mt-5">Empty. Return <a href="/home">Home.</a></h1>
        </td>
        @endforelse
    </tbody>
    </table>
    @else
    <h1 class="text-center mt-5">Empty. Return <a href="/home">Home.</a></h1>
    @endif
  </form>
  <div class="container align-items-center">
    <div class="d-inline-flex justify-content-center">{{ $blogs->links() }}</div>
  </div>
  
  {{-- {{!-- MODAL --}}
  <div class="modal" tabindex="-1" id="delete-modal" tabindex="-1" aria-labelledby="delete-modal-Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Bạn có chắc chắn xóa?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-danger">Xóa</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        </div>
      </div>
    </div>
  </div>
  {{-- {{!-- HIDDEN FORM --}}
  <form method="POST" id="formHidden" hidden="true">
    @csrf
    <input type="hidden" name="_method" value="None" id="hidden-method">
  </form>
  <script>
    document.addEventListener('DOMContentLoaded', function(){
      let id = '';
      const formSelect = $('#formSelect');
      const hiddenMethod = $('#hidden-method');
      const selectAll = $('#select-all');
      const checkboxes = $('input[name="courseIDs[]"]');
      const deleteButton = document.querySelector('.btn-danger');
      const restoreButton = document.querySelector('#restore_btn');
      const btnSubmit = $('#formSelectBtn');
      const visibleForm = $('#visible-form');
      const actionMethod = $('#actionMethod');
      const deleteModal = document.querySelector('#delete-modal');
      const formHidden = document.querySelector('#formHidden');
      if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (e){
            id = e.relatedTarget.getAttribute('data-id');
        })
      }
      if(deleteButton){
        deleteButton.addEventListener('click', function(){
          formHidden.action = `/blog/${id}/delete`;
          $('#hidden-method').val('DELETE');
          formHidden.submit();
        })
      }
      if (restoreButton) {
        restoreButton.addEventListener('click', function(e){
          const id = e.target.getAttribute('data-id');
          formHidden.action = `/dashboard/restore/${id}`;
          $('#hidden-method').val('PATCH');
          formHidden.submit();
        })
      }
      selectAll.change(function(){
        checkboxes.prop('checked', $(this).prop('checked'));
        reRenderBtn();
      })
  
      checkboxes.change(function(){
        selectAll.prop('checked', checkboxes.length === $('input[name="courseIDs[]"]:checked').length);
        reRenderBtn();
      })

      actionMethod.change(function(e){
        if (e.target.value === 'delete') {
          visibleForm.val('DELETE');
          formSelect.attr('action', '/dashboard/delete');
        } else if (e.target.value === 'restore') {
          visibleForm.val('PATCH');
          formSelect.attr('action', '/dashboard/restore?all=true');
        }
      })
  
      function reRenderBtn(){
        if ($('input[name="courseIDs[]"]:checked').length > 0) {
            btnSubmit.removeClass('disabled');
        } else {
            btnSubmit.addClass('disabled');
        }
      }
    })
  </script>
@endsection