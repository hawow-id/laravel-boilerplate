<?php


namespace App\Contracts;

use Illuminate\Http\Request;

interface RepositoryContract
{
    public function index(Request $request);
    public function create(Request $request);
    public function store(Request $request);
    public function show(Request $request, $id);
    public function edit(Request $request, $id);
    public function update(Request $request, $id);
    public function destroy(Request $request, $id);
}
