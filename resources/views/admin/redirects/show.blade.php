@section('header')
    <h1>SEO <small>Redirection details</small></h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h2 class="box-title">Redirection details</h2>
                </div>
                <div class="box-body no-padding">
                    <div class="table-responsive">
                        <table class="table table-condensed table-hover no-margin">
                            <tr>
                                <td><b>Old URL :</b></td>
                                <td>
                                    <span class="label label-default">{{ $redirect->old_url }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><b>New URL :</b></td>
                                <td>
                                    <span class="label label-primary">{{ $redirect->new_url }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Status :</b></td>
                                <td>
                            <span class="label label-inverse">
                                {{ $redirect->status_name }}
                            </span>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Created at :</b></td>
                                <td>
                                    <small>{{ $redirect->created_at }}</small>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Updated at :</b></td>
                                <td>
                                    <small>{{ $redirect->updated_at }}</small>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="box-footer text-right">
                    <a href="#deleteRedirectModal" class="btn btn-sm btn-danger">
                        <i class="fa fa-fw fa-trash-o"></i> Delete
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')
@endsection

@section('scripts')
@endsection
