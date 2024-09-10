<?php
    use Filament\Support\Enums\Alignment;
?>

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'actions' => [],
    'alignment' => Alignment::Start,
    'fullWidth' => false,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'actions' => [],
    'alignment' => Alignment::Start,
    'fullWidth' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    if (is_array($actions)) {
        $actions = array_filter(
            $actions,
            fn ($action): bool => $action->isVisible(),
        );
    }

    if (! $alignment instanceof Alignment) {
        $alignment = filled($alignment) ? (Alignment::tryFrom($alignment) ?? $alignment) : null;
    }

    $hasActions = false;

    $hasSlot = ! \Filament\Support\is_slot_empty($slot);
    $actionsAreHtmlable = $actions instanceof \Illuminate\Contracts\Support\Htmlable;

    if ($hasSlot) {
        $hasActions = true;
    } elseif ($actionsAreHtmlable) {
        $hasActions = ! \Filament\Support\is_slot_empty($actions);
    } else {
        $hasActions = filled($actions);
    }
?>

<!--[if BLOCK]><![endif]--><?php if($hasActions): ?>
    <div
        <?php echo e($attributes->class([
                'fi-ac gap-3',
                'flex flex-wrap items-center' => ! $fullWidth,
                match ($alignment) {
                    Alignment::Start, Alignment::Left => 'justify-start',
                    Alignment::Center => 'justify-center',
                    Alignment::End, Alignment::Right => 'flex-row-reverse',
                    Alignment::Between, Alignment::Justify => 'justify-between',
                    default => $alignment,
                } => ! $fullWidth,
                'grid grid-cols-[repeat(auto-fit,minmax(0,1fr))]' => $fullWidth,
            ])); ?>

    >
        <!--[if BLOCK]><![endif]--><?php if($hasSlot): ?>
            <?php echo e($slot); ?>

        <?php elseif($actionsAreHtmlable): ?>
            <?php echo e($actions); ?>

        <?php else: ?>
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($action); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->
<?php /**PATH C:\laragon\www\app-project-management\vendor\filament\support\src\/../resources/views/components/actions.blade.php ENDPATH**/ ?>