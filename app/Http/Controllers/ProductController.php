<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use CodeCoz\AimAdmin\Field\ButtonField;
use CodeCoz\AimAdmin\Field\TextareaField;
use CodeCoz\AimAdmin\Helpers\Helper;
use Illuminate\Http\RedirectResponse;

use CodeCoz\AimAdmin\Controller\AbstractAimAdminController;
use CodeCoz\AimAdmin\Field\IdField;
use CodeCoz\AimAdmin\Field\TextField;

use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Contracts\Services\ProductServiceInterface;

class ProductController extends AbstractAimAdminController
{
    private ProductServiceInterface $productService;

    public function __construct(private readonly ProductRepositoryInterface $repo, ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function getRepository()
    {
        return $this->repo;
    }

    public function configureActions(): iterable
    {
        return [
            ButtonField::init(ButtonField::DETAIL)->linkToRoute('product.show', function ($row) {
                return ['id' => $row->id];
            }),
            ButtonField::init(ButtonField::EDIT)->linkToRoute('product.edit'),
            ButtonField::init(ButtonField::DELETE)->linkToRoute('product.delete', function ($row) {
                return ['id' => $row->id];
            }),
            // ButtonField::init(ButtonField::DETAIL)->linkToRoute('article_category_detail'),
            ButtonField::init('new', 'new')->linkToRoute('product.create')->createAsCrudBoardAction(),
            ButtonField::init('submit')->createAsFormSubmitAction(),
            ButtonField::init('cancel')->linkToRoute('product.list')->createAsFormAction(),
            ButtonField::init('back')->linkToRoute('product.list')->createAsShowAction()->setIcon('fa-arrow-left'),
            ButtonField::init('submit', 'Search')->createAsFilterSubmitAction(),
            ButtonField::init('reset', 'Reset')->linkToRoute('product.list')->createAsFilterAction()

        ];
    }

    public function configureForm(): void
    {
        $fields = [
            IdField::init('id'),
            TextField::init('name'),
            TextareaField::init('description'),
            TextField::init('price')->setInputType('number'),
            TextField::init('stock')->setInputType('number'),
        ];
        $this->getForm($fields)
            ->setName('form_name')
            ->setMethod('post')
            ->setActionUrl(Helper::getAttribute('route'));
    }

    public function create()
    {
        Helper::setAttribute('route', route('product.store'));
        $this->initCreate();
        return view('aim-admin::create');
    }

    public function store(ProductStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        if ($this->productService->store($validated)) {
            return redirect(route('product.list'))->with('success', 'Product added successfully');
        }
        return redirect()->back()->with('error', 'Product failed to add');
    }

    public function configureFilter(): void
    {
        $fields = [
            TextField::init('name'),
            TextField::init('description'),
            // TextField::init('other')
        ];
        $this->getFilter($fields);
    }

    public function list()
    {
        $this->initGrid(['id', 'name', 'price', 'stock'], pagination: 10)->setTitle('Product List');
        return view('aim-admin::list');
    }

    public function show($id)
    {
        $this->initShow($id, ['name', 'description', 'price', 'stock', 'created_at']);
        return view('aim-admin::show');
    }

    public function edit($id)
    {
        Helper::setAttribute('route', route('product.update'));
        $this->initEdit($id);
        return view('aim-admin::edit');
    }

    public function update(ProductUpdateRequest $request)
    {
        $validated = $request->validated();
        $id = $validated['id'];
        if ($this->productService->update($id, $validated)) {
            return redirect(route('product.list'))->with('success', 'Product updated successfully');
        }

        return redirect()->back()->with('error', 'Product update failed');
    }

    public function delete($id)
    {
        if ($this->productService->delete($id)) {
            return redirect(route('product.list'))->with('success', 'Product deleted successfully');
        }
        return redirect(route('product.list'))->with('error', 'Product failed to delete');
    }

}
