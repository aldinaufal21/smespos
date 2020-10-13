<tbody>
    <?php $i = 1; ?>
        @foreach($barang as $b)
        <tr>
            <td class="text-center">{{$loop->iteration}}</td>
            <td>{{$b->nama}}</td>
            <td>{{$b->harga}}</td>

            <td>
                <a href="{{url('/edit')}" class="btn btn-xs btn-primary">Edit</a> |
                <a href="#" class="btn btn-xs btn-danger" onclick="return confirm('yakin?');">Delete</a>
            </td>
        </tr>
        @endforeach
</tbody>

<a class="btn btn-primary float-right mt-2" href="/barang/create" role="button">Tambah Buku</a>