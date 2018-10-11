            <table class="table table-bordered table-striped table-responsive {{ count($papers) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th>@lang('id')</th>
                        <th>@lang('quickadmin.papers.fields.title')</th>
                        <th>@lang('quickadmin.papers.fields.name')</th>
                        <th>@lang('quickadmin.papers.fields.type')</th>
                        <th>@lang('Date')</th>
                        <th>@lang('quickadmin.papers.fields.session')</th>
                        <th>@lang('Room')</th>
                        <th>@lang('quickadmin.papers.fields.art')</th>
                        <th>@lang('quickadmin.papers.fields.duration')</th>
                        <th>@lang('Θέσεις')</th>
                        <th></th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($papers) > 0)
                        @foreach ($papers as $paper)
                            <tr data-entry-id="{{ $paper->id }}">

                                <td field-key='id'>{{$paper->id}}</td>
                                <td field-key='title'>
                                    <a href="{{ route('frontend.papers.show',[$paper->id]) }}" >{{ $paper->title }}</a>
                                </td>
                                <td field-key='name'>{{ $paper->name }}</td>
                                <td field-key='type'><a href="{{route('frontend.papers.index',['type'=> $paper->type ])}}">{{ $paper->type }}</a></td>
                                <td field-key='date'>
                                    @if ($paper->session)
                                        {{ (new gateweb\common\DateTime($paper->session->start))->format('d M') }}
                                    @endif
                                </td>
                                
                                <td field-key='session'>
                                    @if ($paper->session)
                                        <a href="{{route('frontend.sessions.show',$paper->session->id)}}">{{ "S". $paper->session->id.". ".$paper->session->title }}</a> <span class="text-secondary"><i class="fa fa-clock"></i> {{(new gateweb\common\DateTime($paper->session->start))->format('H:i')}}</span>
                                    @endif
                                </td>
                                <td field-key='room'>
                                    @if ($paper->session)
                                        <a href="{{route('frontend.rooms.show',$paper->session->room->id)}}">{{ $paper->session->room->title or '' }}</a>    
                                    @endif
                                    
                                </td>
                                <td field-key='art'>
                                    @foreach ($paper->art as $singleArt)
                                        <a href="{{route('frontend.arts.show',$singleArt->id)}}" class="badge badge-secondary m-md-1" >{{ $singleArt->title }} </a>
                                    @endforeach
                                </td>
                                <td field-key='duration'>{{ $paper->duration }}'</td>
                                <td field-key='availability'>@if ($paper->availability) <span class="text-success font-weight-bold">✓</span> @else <span class="text-secondary font-weight-bold">x</span @endif</td>
                                <td field-key='button'><a class="btn btn-xs btn-primary" href="{{ route('frontend.papers.show',[$paper->id]) }}"> @lang('quickadmin.qa_view') </a></td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="21">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
