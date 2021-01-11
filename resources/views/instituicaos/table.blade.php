<div class="table-responsive">
    <table class="table" id="instituicaos-table">
        <thead>
            <tr>
                <th>Nminstituicao</th>
        <th>Endereco</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($instituicaos as $instituicao)
            <tr>
                <td>{{ $instituicao->NmInstituicao }}</td>
            <td>{{ $instituicao->Endereco }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['instituicaos.destroy', $instituicao->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('instituicaos.show', [$instituicao->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('instituicaos.edit', [$instituicao->id]) }}" class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
