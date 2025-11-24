<?php

namespace App\Repository\Fees_invoices;

interface Fees_invoicesRepositoryInterface
{
    public function index();

    public function ShowFeesInvoice($id);

    public function store($request);

    public function edit($id);

    public function update($request);

    public function delete($request);

}
