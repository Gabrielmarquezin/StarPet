<?php
namespace Boringue\Backend\aplication\useCase;

use Boringue\Backend\aplication\repositories\PetRepository;
use Boringue\Backend\aplication\repositories\ProductRepository;
use Boringue\Backend\aplication\useCase\contract\PetCaseInterface;
use Boringue\Backend\config\Database;
use Boringue\Backend\domain\entities\CategoriaEntity;
use Boringue\Backend\domain\entities\FichaPetEntity;
use Boringue\Backend\domain\entities\PetEntity;
use Boringue\Backend\file\RenderFile;
use Exception;

class PetCase implements PetCaseInterface{
    private $dados;

    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    public function addPet(PetEntity $pet, FichaPetEntity $ficha_pet, PetRepository $pet_repository)
    {
        $dados = $this->dados;

        $produto_repository = new ProductRepository(new Database());

        $categoria = $dados['categoria'];

        if(!empty($dados['photo'])) {
            $arquivo = $dados['photo'];
            $file = new RenderFile($arquivo);
            $dados['photo'] = $file->Render();            
        }

        $pet->setPhoto($dados['photo'])
            ->setDesc($dados['descricao'])
            ->setEstoque($dados['quantidade'])
            ->setNome($dados['nome'])
            ->setPreco($dados['preco']);
        
        $ficha_pet->setRaca($dados['ficha_pet']['raca'])
                  ->setAlergias($dados['ficha_pet']['alergias'])
                  ->setObservacoes($dados['ficha_pet']['observacoes'])
                  ->setTamanho($dados['ficha_pet']['tamanho'])
                  ->setEstoque($dados['ficha_pet']['estoque']);

        try{
//adicionando categoria
            $getCategoria = $produto_repository->findCategoriaForName(new CategoriaEntity($categoria));
            if(!empty($getCategoria[0])){
                $idcat = $getCategoria[0]['codigo'];
                $pet->setCodCategoria($idcat);
            }else{
                $idcat = $produto_repository->addCategoria(new CategoriaEntity($categoria));
                $pet->setCodCategoria($idcat);
            }

//adicionando ficha tecnica
            $id_ficha_pet = $pet_repository->addFichaPet($ficha_pet);
            $pet->setCodFihcaTec($id_ficha_pet);

//adicionando pet
            $cod = $pet_repository->add($pet);
            
            return $cod;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function addPetAdocao(PetEntity $pet, FichaPetEntity $ficha_pet, PetRepository $pet_repository){
        $dados = $this->dados;

        $produto_repository = new ProductRepository(new Database());

        $categoria = $dados['categoria'];

        if(!empty($dados['photo'])) {
            $arquivo = $dados['photo'];
            $file = new RenderFile($arquivo);
            $dados['photo'] = $file->Render();            
        }

        $pet->setPhoto($dados['photo'])
            ->setDesc($dados['descricao'])
            ->setNome($dados['nome']);
        
        $ficha_pet->setRaca($dados['ficha_pet']['raca'])
                  ->setAlergias($dados['ficha_pet']['alergias'])
                  ->setObservacoes($dados['ficha_pet']['observacoes'])
                  ->setTamanho($dados['ficha_pet']['tamanho'])
                  ->setEstoque($dados['ficha_pet']['estoque']);

        try{
//adicionando categoria
            $getCategoria = $produto_repository->findCategoriaForName(new CategoriaEntity($categoria));
            if(!empty($getCategoria[0])){
                $idcat = $getCategoria[0]['codigo'];
                $pet->setCodCategoria($idcat);
            }else{
                $idcat = $produto_repository->addCategoria(new CategoriaEntity($categoria));
                $pet->setCodCategoria($idcat);
            }

//adicionando ficha tecnica
            $id_ficha_pet = $pet_repository->addFichaPet($ficha_pet);
            $pet->setCodFihcaTec($id_ficha_pet);

//adicionando pet
            $cod = $pet_repository->addPetAdocao($pet);
            
            return $cod;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function getPet(PetEntity $pet, PetRepository $pet_repository)
    {
        $dados = $this->dados;

        if($dados['idPet'] == 0){
            try{
                $pets = $pet_repository->findAll(new PetEntity());

                return $pets;
            }catch(Exception $e){
                throw new Exception($e->getMessage());
            }

        }else{
            $pet->setCod($dados['idPet']);
            try{
                $getpet = $pet_repository->find($pet);

                return $getpet;
            }catch(Exception $e){
                throw new Exception(json_encode($e->getMessage()));
            }
        }
    }

    public function getPetAdocao(PetEntity $pet, PetRepository $pet_repository){
        $dados = $this->dados;

        if($dados['idPet'] == 0){
            try{
                $pets = $pet_repository->findAllpetAdocao(new PetEntity());

                return $pets;
            }catch(Exception $e){
                throw new Exception($e->getMessage());
            }

        }else{
            $pet->setCod($dados['idPet']);
            try{
                $getpet = $pet_repository->findPetAdocao($pet);

                return $getpet;
            }catch(Exception $e){
                throw new Exception(json_encode($e->getMessage()));
            }
        }
    }

    public function getByCategoria(PetEntity $pet, PetRepository $pet_repository)
    {
        $categoria = ($this->dados)['categoria'];
        try{
            $pets = $pet_repository->findByCategoria($pet, new CategoriaEntity($categoria));

            return $pets;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function getByCategoriaPetAdocao(PetEntity $pet, PetRepository $pet_repository)
    {
        $categoria = ($this->dados)['categoria'];
        try{
            $pets = $pet_repository->findByCategoriaPetAdocao($pet, new CategoriaEntity($categoria));

            return $pets;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
    
    public function updatePet(PetEntity $pet, PetRepository $pet_repository)
    {
        $dados = $this->dados;

        if(!empty($dados['photo'])) {
            $arquivo = $dados['photo'];
            $file = new RenderFile($arquivo);
            $dados['photo'] = $file->Render();            
        }

        $pet->setCod($dados['cod'])
            ->setDesc($dados['descricao'])
            ->setNome($dados['nome'])
            ->setPhoto($dados['photo'])
            ->setPreco($dados['preco']);

        try{
            $response = $pet_repository->updatePet($pet);

            return $response;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function updatePetAdocao(PetEntity $pet, PetRepository $pet_repository)
    {
        $dados = $this->dados;

        if(!empty($dados['photo'])) {
            $arquivo = $dados['photo'];
            $file = new RenderFile($arquivo);
            $dados['photo'] = $file->Render();            
        }

        $pet->setCod($dados['cod'])
            ->setDesc($dados['descricao'])
            ->setNome($dados['nome'])
            ->setPhoto($dados['photo']);

        try{
            $response = $pet_repository->updatePetAdocao($pet);

            return $response;
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function deletePet(PetEntity $pet, PetRepository $pet_repository)
    {
        $cod = ($this->dados)['idPet'];
        $pet->setCod($cod);

        try{
            $pet_repository->deletePet($pet);

            return "pet deletado";
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function deletePetAdocao(PetEntity $pet, PetRepository $pet_repository)
    {
        $cod = ($this->dados)['idPet'];
        $pet->setCod($cod);

        try{
            $pet_repository->deletePetAdocao($pet);

            return "pet deletado";
        }catch(Exception $e){
            throw new Exception($e->getMessage());
        }
    }
}