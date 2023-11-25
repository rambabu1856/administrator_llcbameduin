<x-layouts.administrator.layout>
  <x-slot name="css"></x-slot>

  <x-slot name="content">

    <x-layouts.administrator.content_header contentHeader="dashboard">

      <x-button.dropdown :links="[
          ['url' => '/link1', 'text' => 'Long Roll'],
          ['url' => '/link2', 'text' => 'Contact Details'],
          ['url' => '/link2', 'text' => 'Migration Details'],
          ['url' => '/link2', 'text' => 'Phone Numbers'],
      ]" btnClass="btn btn-success dropdown-toggle" />

    </x-layouts.administrator.content_header>

    <section class="content">
      <div class="container-fluid">
        {{-- SEARCH FORM --}}
        <x-card.card-heading heading="Filter" name="headingSearchForm">

          <x-card.card-body>
            Card Body Content
          </x-card.card-body>

        </x-card.card-heading>
      </div>
    </section>

  </x-slot>

  <x-slot name="script">
  </x-slot>

</x-layouts.administrator.layout>
