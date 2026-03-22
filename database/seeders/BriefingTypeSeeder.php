<?php

namespace Database\Seeders;

use App\Models\BriefingType;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class BriefingTypeSeeder extends Seeder
{
    public function run(): void
    {
        BriefingType::create([
            'name'        => 'Presença Digital',
            'slug'        => 'presenca-digital',
            'description' => 'Briefing completo gamificado para criação de sites',
            'schema'      => $this->schema(),
            'active'      => true,
            'sort_order'  => 1,
        ]);

        Setting::updateOrCreate(
            ['key' => 'notification_email'],
            ['value' => 'briefing@webspaceship.com.br', 'group' => 'email']
        );
    }

    private function schema(): array
    {
        return [
            ['name' => '🎯 1. Negócio', 'icon' => 'fa-building', 'fields' => [
                ['label' => 'Nome da empresa', 'type' => 'text',     'name' => 'empresa',           'required' => true, 'placeholder' => 'Ex: LevelUp Tech'],
                ['label' => 'CNPJ',            'type' => 'text',     'name' => 'cnpj',              'placeholder' => '00.000.000/0001-00'],
                ['label' => 'Segmento',        'type' => 'text',     'name' => 'segmento'],
                ['label' => 'Tempo no mercado','type' => 'text',     'name' => 'tempo_mercado'],
                ['label' => 'Descrição',       'type' => 'textarea', 'name' => 'descricao_empresa', 'rows' => 3],
                ['label' => 'Produtos/Serviços','type' => 'text',    'name' => 'produtos'],
                ['label' => 'Diferenciais',    'type' => 'textarea', 'name' => 'diferenciais',      'rows' => 3],
                ['label' => 'Localização',     'type' => 'text',     'name' => 'localizacao'],
                ['label' => 'Atendimento',     'type' => 'select',   'name' => 'atendimento',       'options' => ['Local','Regional','Nacional','Online']],
                ['label' => 'Equipe',          'type' => 'text',     'name' => 'equipe',            'placeholder' => 'Quantas pessoas?'],
            ]],
            ['name' => '🎯 2. Objetivos', 'icon' => 'fa-bullseye', 'fields' => [
                ['label' => 'Objetivos do site',          'type' => 'checkboxes', 'name' => 'objetivos_site',  'options' => ['Gerar leads/clientes','Vender online','Apresentar a empresa','Fortalecer autoridade','Centralizar informações']],
                ['label' => 'O que seria um site de sucesso?', 'type' => 'textarea', 'name' => 'sucesso_def', 'rows' => 3],
                ['label' => 'Meta específica',            'type' => 'text',       'name' => 'meta_especifica'],
            ]],
            ['name' => '👥 3. Público-alvo', 'icon' => 'fa-users', 'fields' => [
                ['label' => 'Cliente ideal',    'type' => 'textarea',   'name' => 'cliente_ideal',    'rows' => 3],
                ['label' => 'Faixa etária',     'type' => 'text',       'name' => 'faixa_etaria'],
                ['label' => 'Região',           'type' => 'text',       'name' => 'regiao_cliente'],
                ['label' => 'Perfil',           'type' => 'text',       'name' => 'perfil_cliente'],
                ['label' => 'Dores do cliente', 'type' => 'textarea',   'name' => 'dores_cliente',    'rows' => 3],
                ['label' => 'Canais de aquisição', 'type' => 'checkboxes', 'name' => 'canais_encontram', 'options' => ['Instagram','Google','Indicação','Tráfego pago']],
            ]],
            ['name' => '🏷️ 4. Marca', 'icon' => 'fa-palette', 'fields' => [
                ['label' => 'Possui logotipo?',         'type' => 'select', 'name' => 'possui_logo',      'options' => ['Sim','Não']],
                ['label' => 'Cores principais',         'type' => 'text',   'name' => 'cores_principais'],
                ['label' => 'Tipografia',               'type' => 'text',   'name' => 'tipografia'],
                ['label' => 'Percepção desejada',       'type' => 'text',   'name' => 'percepcao_marca'],
                ['label' => '3 palavras que definem a marca', 'type' => 'text', 'name' => 'palavras_marca'],
            ]],
            ['name' => '💡 5. Referências', 'icon' => 'fa-star', 'fields' => [
                ['label' => 'Sites favoritos',  'type' => 'textarea', 'name' => 'sites_referencias', 'rows' => 3],
                ['label' => 'O que gosta neles?','type' => 'textarea', 'name' => 'gostos_ref',       'rows' => 3],
                ['label' => 'Concorrentes',     'type' => 'text',     'name' => 'concorrentes'],
            ]],
            ['name' => '🧱 6. Estrutura', 'icon' => 'fa-layer-group', 'fields' => [
                ['label' => 'Páginas necessárias', 'type' => 'checkboxes', 'name' => 'paginas_site', 'options' => ['Home','Sobre','Serviços','Portfólio','Blog','Contato','FAQ']],
            ]],
            ['name' => '⚙️ 7. Funcionalidades', 'icon' => 'fa-cogs', 'fields' => [
                ['label' => 'Funcionalidades', 'type' => 'checkboxes', 'name' => 'funcionalidades', 'options' => ['WhatsApp','Formulário','Blog','Loja virtual','Agendamento','CRM','Chat','SEO']],
            ]],
            ['name' => '🎨 8. Design', 'icon' => 'fa-brush', 'fields' => [
                ['label' => 'Estilo',  'type' => 'select', 'name' => 'estilo_design', 'options' => ['Minimalista','Moderno','Corporativo','Criativo','Sofisticado']],
                ['label' => 'Layout', 'type' => 'select', 'name' => 'layout_pref',   'options' => ['One page','Multi páginas']],
            ]],
            ['name' => '📝 9. Conteúdo', 'icon' => 'fa-file-alt', 'fields' => [
                ['label' => 'Quem fornece os textos?', 'type' => 'select', 'name' => 'fornecedor_textos', 'options' => ['Cliente','Agência','Ambos']],
            ]],
            ['name' => '📸 10. Mídia', 'icon' => 'fa-camera', 'fields' => [
                ['label' => 'Fotos profissionais?', 'type' => 'select', 'name' => 'fotos_profissionais', 'options' => ['Sim','Não']],
            ]],
            ['name' => '📢 11. Marketing', 'icon' => 'fa-chart-bar', 'fields' => [
                ['label' => 'Deseja SEO?',    'type' => 'select', 'name' => 'seo_desejado',  'options' => ['Sim','Não']],
                ['label' => 'Palavras-chave', 'type' => 'text',   'name' => 'palavras_chave'],
            ]],
            ['name' => '🌐 12. Domínio', 'icon' => 'fa-server', 'fields' => [
                ['label' => 'Domínio',     'type' => 'text',   'name' => 'dominio',     'placeholder' => 'seusite.com.br'],
                ['label' => 'Hospedagem',  'type' => 'select', 'name' => 'hospedagem',  'options' => ['Sim','Não','Preciso']],
            ]],
            ['name' => '⚖️ 13. Legal', 'icon' => 'fa-gavel', 'fields' => [
                ['label' => 'Documentos legais', 'type' => 'checkboxes', 'name' => 'documentos_legais', 'options' => ['LGPD','Termos de uso']],
            ]],
            ['name' => '📅 14. Prazo', 'icon' => 'fa-calendar', 'fields' => [
                ['label' => 'Prazo desejado', 'type' => 'text',   'name' => 'prazo'],
                ['label' => 'Investimento',   'type' => 'select', 'name' => 'investimento', 'options' => ['Até R$5k','R$5k a R$15k','R$15k a R$30k','Aberto']],
            ]],
            ['name' => '👤 15. Responsável', 'icon' => 'fa-id-card', 'fields' => [
                ['label' => 'Nome',      'type' => 'text',  'name' => 'responsavel_nome'],
                ['label' => 'E-mail',    'type' => 'email', 'name' => 'responsavel_email',   'placeholder' => 'usuario@email.com'],
                ['label' => 'Telefone',  'type' => 'text',  'name' => 'responsavel_contato'],
            ]],
            ['name' => '📌 16. Observações', 'icon' => 'fa-pen', 'fields' => [
                ['label' => 'Informações adicionais', 'type' => 'textarea', 'name' => 'observacoes_gerais', 'rows' => 4],
            ]],
        ];
    }
}