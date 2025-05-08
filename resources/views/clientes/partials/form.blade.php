<div class="mb-3">
    <label for="nome" class="form-label">Nome</label>
    <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome', $cliente->nome ?? '') }}">
    @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="cpf" class="form-label">CPF</label>
    <input type="text" name="cpf" class="form-control @error('cpf') is-invalid @enderror" value="{{ old('cpf', $cliente->cpf ?? '') }}">
    @error('cpf') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="rg" class="form-label">RG</label>
    <input type="text" name="rg" class="form-control @error('rg') is-invalid @enderror" value="{{ old('rg', $cliente->rg ?? '') }}">
    @error('rg') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
    <input type="date" name="data_nascimento" class="form-control @error('data_nascimento') is-invalid @enderror" value="{{ old('data_nascimento', isset($cliente) ? $cliente->data_nascimento->format('Y-m-d') : '') }}">
    @error('data_nascimento') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="telefone" class="form-label">Telefone</label>
    <input type="text" name="telefone" class="form-control @error('telefone') is-invalid @enderror" value="{{ old('telefone', $cliente->telefone ?? '') }}">
    @error('telefone') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $cliente->email ?? '') }}">
    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="senha" class="form-label">Senha</label>
    <input type="password" name="senha" class="form-control @error('senha') is-invalid @enderror">
    @error('senha') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
