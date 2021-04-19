<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudante;

class EstudanteController extends Controller
{
    //
    public function ver()
    {
        $estudantes = Estudante::OrderBy('nome')->get();

        return view('ver-estudantes', compact('estudantes'));
    }

    public function upload_pp()
    {
        if ($_FILES["file"] ["name"] != '') {
            # code...
            $test = explode('.', $_FILES["file"] ["name"]);
            $ext = end($test);
            $name = date_format(now(),'YmdHis').'-'.rand(100, 999) . '.' . $ext;

            if (!file_exists('storage/images')) {
                # code...
                mkdir('storage/images', 0777, true);
            }
            $location = 'storage/images/'.$name;

            if ($ext == 'jpg' || $ext = 'jpeg' || $ext == 'png') {
                # code...

                move_uploaded_file($_FILES["File"] ["tmp_name"], $location);
                $pp_orientation = Image::make(public_path($location))->exif("Orientation");

                     if($pp_orientation == 6 || $pp_orientation == 8) {
                         # code...
                         $pp_resize = Image::make(public_path($location))->orientate()->resize('150', '250');
                     }else {
                         # code...
                         $pp_resize->save();

                         echo '<img src="'.url($location).'" style="height:180px;width:120px;" class="img-thumbnail" /><br><h6>Image successfully uploaded!</h6><input type="text" name="thumbnail" value="'.$location.'" hidden>';
                     }
            } else {
                # code...
                echo '<h4 class="text-danger">Invalid file type, try again by refreshing.</h4>';
            }
            
        }
    }
    public function store()
    {
        $data = request()->validate([
            'nome' => 'required|string|min:3',
            'nome_meio' => 'sometimes',
            'sobrenome' => 'required|string',
            'data_nascimento' => 'required|date',
            'qualificacao' => 'required|string',
            'local_nascimento' => 'sometimes',
            'email' => 'required|email|unique:estudantes',
            'contato' => 'required|numeric|digits_between:10,11',
        ]);

        $estudante = Estudante::create($data);

        if (isset($_POST['thumbnail'])) {
            # code...
            $estudante->update([
                'imagem_perfil' => $_POST['thumbnail'],
            ]);

            return redirect('/ver-estudantes');
        }
    }
}
