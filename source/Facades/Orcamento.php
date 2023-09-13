<?php

namespace Source\Facades;

use Source\Models\Produto;

class Orcamento
{
    public function __construct()
    {
        if (!session_id()) {
            session_start();
        }

        $_SESSION["orcamento"] = (!empty($_SESSION["orcamento"]) ? $_SESSION["orcamento"] : []);
    }


    public function orcamentos(): ?array
    {
        return $_SESSION["orcamento"];
    }

    public function add(Produto $product): Orcamento
    {
        $_SESSION["orcamento"]["total"] = ($_SESSION["orcamento"]["total"] ?? 0);
        $_SESSION["orcamento"]["total"] += $product->preco;

        $_SESSION["orcamento"]["amount"] = ($_SESSION["orcamento"]["amount"] ?? 0);
        $_SESSION["orcamento"]["amount"] += 1;

        if (empty($_SESSION["orcamento"]["items"][$product->id])) {
            $_SESSION["orcamento"]["items"][$product->id] = [
                "id" => $product->id,
                "product" => $product->nome,
                "preco" => $product->preco,
                "total" => $product->preco,
                "amount" => 1
            ];
            return $this;
        }
        $_SESSION["orcamento"]["items"][$product->id]["amount"] += 1;
        $_SESSION["orcamento"]["items"][$product->id]["total"] += $product->preco;

        return $this;
    }

    public function remove(Produto $product): Orcamento
    {
        if (!empty($_SESSION["orcamento"]["items"][$product->id])) {
            $_SESSION["orcamento"]["total"] -= $product->preco;
            $_SESSION["orcamento"]["amount"] -= 1;

            if ($_SESSION["orcamento"]["items"][$product->id]["amount"] > 1) {
                $_SESSION["orcamento"]["items"][$product->id]["amount"] -= 1;
                $_SESSION["orcamento"]["items"][$product->id]["preco"] -= $product->preco;
                return $this;
            }

            unset($_SESSION["orcamento"]["items"][$product->id]);
            return $this;
        }

        return $this;
    }
    public function clear(): Orcamento
    {
        $_SESSION["orcamento"] = [];
        return $this;
    }
}
