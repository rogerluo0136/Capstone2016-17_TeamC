@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h1 class="text-center">Export Transactions Data</h1>
			
			<div class="panel panel-default">
				<div class="panel-heading">Enter Information for Transactions to Export</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ URL::action('TransactionController@exportTransaction')}}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('start') ? ' has-error' : '' }}">
                            <label class="col-xs-12">Start Date <span class="text-danger">*</span></label>

                            <div class="col-xs-12">
                                <input type="date" class="form-control" name="start" value="{{ old('start') }}" required>

                                @if ($errors->has('start'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('start') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('end') ? ' has-error' : '' }}">
                            <label class="col-xs-12">End Date <span class="text-danger">*</span></label>

                            <div class="col-xs-12">
                                <input type="date" class="form-control" name="end" value="{{ old('end') }}" required>

                                @if ($errors->has('end'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('end') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary pull-center">
                                    Export Data
                                </button>
                            </div>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
