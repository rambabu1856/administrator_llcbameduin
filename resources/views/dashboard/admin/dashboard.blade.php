<x-layouts.administrator.layout>
  <x-slot name="css"></x-slot>

  <x-slot name="content">

    <x-layouts.administrator.content_header contentHeader="STUDENT PROFILE">

      <x-button.dropdown :links="[
          ['url' => '/link1', 'text' => 'Long Roll'],
          ['url' => '/link2', 'text' => 'Contact Details'],
          ['url' => '/link2', 'text' => 'Migration Details'],
          ['url' => '/link2', 'text' => 'Phone Numbers'],
      ]" btnClass="btn btn-success dropdown-toggle" />

    </x-layouts.administrator.content_header>

    <section class="content">
      <h1>Dashboard</h1>
    </section>

  </x-slot>

  <x-slot name="script">
  </x-slot>

</x-layouts.administrator.layout>
